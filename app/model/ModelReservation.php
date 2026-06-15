<?php

class ModelReservation
{
    public static function getByPassenger(int $passengerId): array
    {
        return Model::select(
            'select r.id, t.prix, t.date_depart, t.heure_depart, t.statut,
                    vd.nom as ville_depart_nom, va.nom as ville_arrivee_nom,
                    concat(u.prenom, " ", u.nom) as conducteur,
                    concat(v.marque, " ", v.modele, " - ", v.immatriculation) as vehicule
             from reservation r
             join trajet t on t.id = r.trajet_id
             join ville vd on vd.id = t.ville_depart
             join ville va on va.id = t.ville_arrivee
             join utilisateur u on u.id = t.conducteur_id
             join vehicule v on v.id = t.vehicule_id
             where r.passager_id = :passenger_id
             order by t.date_depart desc, t.heure_depart desc, r.id desc',
            ['passenger_id' => $passengerId]
        );
    }

    public static function getPassengersForDriverTrip(int $trajetId, int $driverId): array
    {
        return Model::select(
            'select u.id, u.prenom, u.nom, u.login, count(*) as nb_places
             from reservation r
             join utilisateur u on u.id = r.passager_id
             join trajet t on t.id = r.trajet_id
             where t.id = :trajet_id and t.conducteur_id = :driver_id and t.statut = "actif"
             group by u.id, u.prenom, u.nom, u.login
             order by u.nom, u.prenom',
            ['trajet_id' => $trajetId, 'driver_id' => $driverId]
        );
    }

    public static function create(int $trajetId, int $passengerId): int
    {
        $id = Model::nextId('reservation');
        Model::execute(
            'insert into reservation (id, trajet_id, passager_id)
             values (:id, :trajet_id, :passager_id)',
            ['id' => $id, 'trajet_id' => $trajetId, 'passager_id' => $passengerId]
        );

        return $id;
    }

    public static function createRandom(int $count): array
    {
        $trajets = Model::select('select id from trajet where statut = "actif"');
        $passagers = Model::select('select id from utilisateur where role = "passager"');

        if (!$trajets || !$passagers) {
            return [
                'created' => 0,
                'message' => 'Aucun trajet actif ou aucun passager disponible.',
                'reservations' => [],
            ];
        }

        $pdo = Model::getPdo();
        $pdo->beginTransaction();
        $created = [];

        try {
            $nextId = Model::nextId('reservation');

            for ($i = 0; $i < $count; $i++) {
                $trajet = $trajets[array_rand($trajets)];
                $passager = $passagers[array_rand($passagers)];
                Model::execute(
                    'insert into reservation (id, trajet_id, passager_id)
                     values (:id, :trajet_id, :passager_id)',
                    [
                        'id' => $nextId,
                        'trajet_id' => (int) $trajet['id'],
                        'passager_id' => (int) $passager['id'],
                    ]
                );
                $created[] = [
                    'id' => $nextId,
                    'trajet_id' => (int) $trajet['id'],
                    'passager_id' => (int) $passager['id'],
                ];
                $nextId++;
            }

            $pdo->commit();

            return [
                'created' => count($created),
                'message' => count($created) . ' reservations aleatoires ont ete ajoutees.',
                'reservations' => $created,
            ];
        } catch (Throwable $exception) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            throw $exception;
        }
    }
}
