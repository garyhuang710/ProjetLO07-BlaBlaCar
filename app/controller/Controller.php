<?php

abstract class Controller
{
    public static function currentUser(): ?array
    {
        if (!array_key_exists('login_id', $_SESSION) || $_SESSION['login_id'] === null || $_SESSION['login_id'] === '') {
            return null;
        }

        return ModelUtilisateur::getById((int) $_SESSION['login_id']);
    }

    protected static function render(string $view, array $data = [], string $title = 'BlaBlaCar LO07'): void
    {
        extract($data);
        require VIEW_ROOT . '/fragments/fragmentHeader.php';
        require VIEW_ROOT . '/' . $view . '.php';
        require VIEW_ROOT . '/fragments/fragmentFooter.php';
    }

    protected static function redirect(string $action, array $params = []): void
    {
        $params = array_merge(['action' => $action], $params);
        header('Location: router.php?' . http_build_query($params));
        exit();
    }

    protected static function requireLogin(): array
    {
        $user = self::currentUser();

        if (!$user) {
            self::redirect('login');
        }

        return $user;
    }

    protected static function requireRole(string $role): array
    {
        $user = self::requireLogin();

        if ($user['role'] !== $role) {
            self::render('home/viewMessage', [
                'heading' => 'Acces refuse',
                'message' => 'Votre role ne permet pas d acceder a cette fonctionnalite.',
                'variant' => 'warning',
                'nextAction' => 'accueil',
                'nextLabel' => 'Retour a l accueil',
            ]);
            exit();
        }

        return $user;
    }

    protected static function requireFields(array $fields, array $source): array
    {
        $values = [];

        foreach ($fields as $field) {
            $value = trim((string) ($source[$field] ?? ''));

            if ($value === '') {
                throw new InvalidArgumentException('Le champ ' . $field . ' est obligatoire.');
            }

            $values[$field] = $value;
        }

        return $values;
    }

    protected static function message(
        string $heading,
        string $message,
        string $variant = 'info',
        string $nextAction = 'accueil',
        string $nextLabel = 'Retour'
    ): void {
        self::render('home/viewMessage', compact('heading', 'message', 'variant', 'nextAction', 'nextLabel'), $heading);
    }
}
