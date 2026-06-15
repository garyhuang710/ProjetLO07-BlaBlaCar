<?php

class ControllerExaminateur extends Controller
{
    public static function superglobales(): void
    {
        self::render('examiner/viewSuperglobales', [
            'session' => $_SESSION,
            'cookies' => $_COOKIE,
        ], 'Superglobales');
    }

    public static function randomReservations(): void
    {
        $result = ModelReservation::createRandom(10);
        self::render('examiner/viewRandomReservations', [
            'result' => $result,
        ], 'Reservations aleatoires');
    }
}
