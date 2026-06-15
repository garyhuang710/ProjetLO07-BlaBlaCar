<?php

class ModelTrajet
{
    private static string $detailsSelect = '
        select t.id, t.prix, t.date_depart, t.heure_depart, t.statut,
               vd.nom as ville_depart_nom, va.nom as ville_arrivee_nom,
               concat(v.marque, " ", v.modele, " - ", v.immatriculation) as vehicule,
               concat(u.prenom, " ", u.nom) as conducteur
        from trajet t
        join ville vd on vd.id = t.ville_depart
        join ville va on va.id = t.ville_arrivee
        join vehicule v on v.id = t.vehicule_id
        join utilisateur u on u.id = t.conducteur_id
    ';

    public static function getByDriver(int $driverId): array
    {
        return Model::select(
            self::$detailsSelect . '
             where t.conducteur_id = :driver_id
             order by t.date_depart desc, t.heure_depart desc',
            ['driver_id' => $driverId]
        );
    }

    public static function getActiveByDriver(int $driverId): array
    {
        return Model::select(
            self::$detailsSelect . '
             where t.conducteur_id = :driver_id and t.statut = "actif"
             order by t.date_depart, t.heure_depart',
            ['driver_id' => $driverId]
        );
    }

    public static function getActiveForDriver(int $trajetId, int $driverId): ?array
    {
        return Model::selectOne(
            self::$detailsSelect . '
             where t.id = :trajet_id and t.conducteur_id = :driver_id and t.statut = "actif"',
            ['trajet_id' => $trajetId, 'driver_id' => $driverId]
        );
    }

    public static function getActive(int $trajetId): ?array
    {
        return Model::selectOne(
            self::$detailsSelect . ' where t.id = :trajet_id and t.statut = "actif"',
            ['trajet_id' => $trajetId]
        );
    }

    public static function getActiveForPassengers(): array
    {
        return Model::select(
            self::$detailsSelect . '
             where t.statut = "actif"
             order by t.date_depart, t.heure_depart'
        );
    }

    public static function create(
        int $villeDepart,
        int $villeArrivee,
        int $conducteurId,
        int $vehiculeId,
        float $prix,
        string $dateDepart,
        string $heureDepart
    ): int {
        $id = Model::nextId('trajet');
        Model::execute(
            'insert into trajet (id, ville_depart, ville_arrivee, conducteur_id, vehicule_id, prix, date_depart, heure_depart, statut)
             values (:id, :ville_depart, :ville_arrivee, :conducteur_id, :vehicule_id, :prix, :date_depart, :heure_depart, "actif")',
            [
                'id' => $id,
                'ville_depart' => $villeDepart,
                'ville_arrivee' => $villeArrivee,
                'conducteur_id' => $conducteurId,
                'vehicule_id' => $vehiculeId,
                'prix' => $prix,
                'date_depart' => $dateDepart,
                'heure_depart' => $heureDepart,
            ]
        );

        return $id;
    }

    public static function closeWithPayments(int $trajetId, int $driverId): array
    {
        $pdo = Model::getPdo();
        $pdo->beginTransaction();

        try {
            $statement = $pdo->prepare(
                'select id, prix from trajet
                 where id = :trajet_id and conducteur_id = :driver_id and statut = "actif"
                 for update'
            );
            $statement->execute(['trajet_id' => $trajetId, 'driver_id' => $driverId]);
            $trajet = $statement->fetch();

            if (!$trajet) {
                $pdo->rollBack();
                return [
                    'success' => false,
                    'message' => 'Le trajet choisi est introuvable, deja cloture ou non rattache a votre compte.',
                ];
            }

            $reservations = Model::select(
                'select passager_id from reservation where trajet_id = :trajet_id',
                ['trajet_id' => $trajetId]
            );
            $prix = (float) $trajet['prix'];

            foreach ($reservations as $reservation) {
                Model::execute(
                    'update utilisateur set solde = solde - :prix where id = :passager_id',
                    ['prix' => $prix, 'passager_id' => (int) $reservation['passager_id']]
                );
                Model::execute(
                    'update utilisateur set solde = solde + :prix where id = :driver_id',
                    ['prix' => $prix, 'driver_id' => $driverId]
                );
            }

            Model::execute(
                'update trajet set statut = "passif" where id = :trajet_id',
                ['trajet_id' => $trajetId]
            );

            $pdo->commit();

            return [
                'success' => true,
                'reservations' => count($reservations),
                'amount' => count($reservations) * $prix,
            ];
        } catch (Throwable $exception) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            throw $exception;
        }
    }
}
