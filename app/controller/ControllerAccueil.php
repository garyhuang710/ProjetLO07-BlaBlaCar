<?php

class ControllerAccueil extends Controller
{
    public static function accueil(): void
    {
        self::render('home/viewAccueil', [
            'user' => self::currentUser(),
        ]);
    }

    public static function erreur(Throwable $exception): void
    {
        http_response_code(500);
        self::render('home/viewError', [
            'message' => 'Une erreur est survenue pendant le traitement de la demande.',
            'details' => DEBUG ? $exception->getMessage() : null,
        ], 'Erreur');
    }
}
