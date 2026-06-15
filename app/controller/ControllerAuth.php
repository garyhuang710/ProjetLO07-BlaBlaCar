<?php

class ControllerAuth extends Controller
{
    public static function login(): void
    {
        self::render('auth/viewLogin', [
            'error' => null,
            'login' => '',
        ], 'Connexion');
    }

    public static function logged(): void
    {
        $login = trim((string) ($_POST['login'] ?? ''));
        $password = trim((string) ($_POST['password'] ?? ''));
        $user = ModelUtilisateur::authenticate($login, $password);

        if (!$user) {
            self::render('auth/viewLogin', [
                'error' => 'Login ou mot de passe incorrect.',
                'login' => $login,
            ], 'Connexion');
            return;
        }

        $_SESSION['login_id'] = (int) $user['id'];
        self::redirect('accueil');
    }

    public static function logout(): void
    {
        $_SESSION['login_id'] = null;
        self::message('Deconnexion', 'Vous etes maintenant deconnecte.', 'success', 'login', 'Se connecter');
    }
}
