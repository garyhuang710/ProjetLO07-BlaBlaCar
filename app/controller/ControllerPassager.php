<?php

class ControllerPassager extends Controller
{
    public static function reservations(): void
    {
        $user = self::requireRole('passager');
        self::render('passenger/viewReservationList', [
            'reservations' => ModelReservation::getByPassenger((int) $user['id']),
        ], 'Mes reservations');
    }

    public static function reservationCreate(): void
    {
        self::requireRole('passager');
        self::render('passenger/viewReservationCreate', [
            'trajets' => ModelTrajet::getActiveForPassengers(),
        ], 'Reserver un trajet');
    }

    public static function reservationCreated(): void
    {
        $user = self::requireRole('passager');
        $trajetId = (int) ($_POST['trajet_id'] ?? 0);

        if (!ModelTrajet::getActive($trajetId)) {
            self::message('Reservation impossible', 'Le trajet selectionne n est pas actif.', 'warning', 'passagerReservationCreate', 'Choisir un trajet');
            return;
        }

        $id = ModelReservation::create($trajetId, (int) $user['id']);
        self::message('Reservation ajoutee', 'Votre reservation a ete enregistree avec l identifiant ' . $id . '.', 'success', 'passagerReservations', 'Voir mes reservations');
    }
}
