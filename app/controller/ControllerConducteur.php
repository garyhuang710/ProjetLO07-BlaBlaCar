<?php

class ControllerConducteur extends Controller
{
    public static function vehicules(): void
    {
        $user = self::requireRole('conducteur');
        self::render('driver/viewVehiculeList', [
            'vehicules' => ModelVehicule::getByOwner((int) $user['id']),
        ], 'Mes vehicules');
    }

    public static function trajets(): void
    {
        $user = self::requireRole('conducteur');
        self::render('driver/viewTrajetList', [
            'trajets' => ModelTrajet::getByDriver((int) $user['id']),
        ], 'Mes trajets');
    }

    public static function trajetCreate(): void
    {
        $user = self::requireRole('conducteur');
        self::render('driver/viewTrajetCreate', [
            'villes' => ModelVille::getAll(),
            'vehicules' => ModelVehicule::getByOwner((int) $user['id']),
        ], 'Ajouter un trajet');
    }

    public static function trajetCreated(): void
    {
        $user = self::requireRole('conducteur');
        $values = self::requireFields(['ville_depart', 'ville_arrivee', 'vehicule_id', 'prix', 'date_depart', 'heure_depart'], $_POST);

        if ((int) $values['ville_depart'] === (int) $values['ville_arrivee']) {
            self::message('Trajet refuse', 'La ville de depart doit etre differente de la ville d arrivee.', 'warning', 'conducteurTrajetCreate', 'Corriger');
            return;
        }

        if (!ModelVehicule::belongsToOwner((int) $values['vehicule_id'], (int) $user['id'])) {
            self::message('Vehicule refuse', 'Ce vehicule ne vous appartient pas.', 'warning', 'conducteurTrajetCreate', 'Corriger');
            return;
        }

        $id = ModelTrajet::create(
            (int) $values['ville_depart'],
            (int) $values['ville_arrivee'],
            (int) $user['id'],
            (int) $values['vehicule_id'],
            (float) $values['prix'],
            $values['date_depart'],
            $values['heure_depart']
        );

        self::message('Trajet ajoute', 'Le trajet actif a ete cree avec l identifiant ' . $id . '.', 'success', 'conducteurTrajets', 'Voir mes trajets');
    }

    public static function trajetPassengersForm(): void
    {
        $user = self::requireRole('conducteur');
        self::render('driver/viewTrajetPassengersForm', [
            'trajets' => ModelTrajet::getActiveByDriver((int) $user['id']),
        ], 'Passagers');
    }

    public static function trajetPassengers(): void
    {
        $user = self::requireRole('conducteur');
        $trajetId = (int) ($_GET['trajet_id'] ?? $_POST['trajet_id'] ?? 0);
        $trajet = ModelTrajet::getActiveForDriver($trajetId, (int) $user['id']);

        if (!$trajet) {
            self::message('Trajet introuvable', 'Ce trajet actif ne vous appartient pas.', 'warning', 'conducteurTrajetPassengersForm', 'Choisir un trajet');
            return;
        }

        self::render('driver/viewTrajetPassengers', [
            'trajet' => $trajet,
            'passagers' => ModelReservation::getPassengersForDriverTrip($trajetId, (int) $user['id']),
        ], 'Passagers du trajet');
    }

    public static function trajetClose(): void
    {
        $user = self::requireRole('conducteur');
        self::render('driver/viewTrajetClose', [
            'trajets' => ModelTrajet::getActiveByDriver((int) $user['id']),
        ], 'Cloturer un trajet');
    }

    public static function trajetClosed(): void
    {
        $user = self::requireRole('conducteur');
        $trajetId = (int) ($_POST['trajet_id'] ?? 0);
        $result = ModelTrajet::closeWithPayments($trajetId, (int) $user['id']);

        if (!$result['success']) {
            self::message('Cloture impossible', $result['message'], 'warning', 'conducteurTrajetClose', 'Choisir un trajet');
            return;
        }

        self::message(
            'Trajet cloture',
            $result['reservations'] . ' reservation(s) traitee(s), pour un transfert total de ' . number_format($result['amount'], 2, ',', ' ') . ' euros.',
            'success',
            'conducteurTrajets',
            'Voir mes trajets'
        );
    }
}
