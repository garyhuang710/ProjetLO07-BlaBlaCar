<?php

class ControllerAdmin extends Controller
{
    public static function utilisateurs(): void
    {
        self::requireRole('administrateur');
        self::render('admin/viewUtilisateurList', [
            'utilisateurs' => ModelUtilisateur::getAll(),
        ], 'Utilisateurs');
    }

    public static function conducteurCreate(): void
    {
        self::requireRole('administrateur');
        self::renderUserForm('conducteur');
    }

    public static function conducteurCreated(): void
    {
        self::createUser('conducteur');
    }

    public static function passagerCreate(): void
    {
        self::requireRole('administrateur');
        self::renderUserForm('passager');
    }

    public static function passagerCreated(): void
    {
        self::createUser('passager');
    }

    public static function vehicules(): void
    {
        self::requireRole('administrateur');
        self::render('admin/viewVehiculeList', [
            'vehicules' => ModelVehicule::getAllWithOwners(),
        ], 'Vehicules');
    }

    public static function vehiculeCreate(): void
    {
        self::requireRole('administrateur');
        self::render('admin/viewVehiculeCreate', [
            'conducteurs' => ModelUtilisateur::getByRole('conducteur'),
        ], 'Ajouter un vehicule');
    }

    public static function vehiculeCreated(): void
    {
        self::requireRole('administrateur');
        $values = self::requireFields(['marque', 'modele', 'annee', 'immatriculation', 'proprietaire_id'], $_POST);
        $id = ModelVehicule::create(
            $values['marque'],
            $values['modele'],
            (int) $values['annee'],
            $values['immatriculation'],
            (int) $values['proprietaire_id']
        );

        self::message('Vehicule ajoute', 'Le vehicule a ete ajoute avec l identifiant ' . $id . '.', 'success', 'adminVehicules', 'Voir les vehicules');
    }

    public static function villes(): void
    {
        self::requireRole('administrateur');
        self::render('admin/viewVilleList', [
            'villes' => ModelVille::getAll(),
        ], 'Villes');
    }

    public static function villeCreate(): void
    {
        self::requireRole('administrateur');
        self::render('admin/viewVilleCreate', [], 'Ajouter une ville');
    }

    public static function villeCreated(): void
    {
        self::requireRole('administrateur');
        $values = self::requireFields(['nom'], $_POST);
        $id = ModelVille::create($values['nom']);

        self::message('Ville ajoutee', 'La ville a ete ajoutee avec l identifiant ' . $id . '.', 'success', 'adminVilles', 'Voir les villes');
    }

    private static function renderUserForm(string $role): void
    {
        self::render('admin/viewUtilisateurCreate', [
            'role' => $role,
            'targetAction' => $role === 'conducteur' ? 'adminConducteurCreated' : 'adminPassagerCreated',
        ], 'Ajouter un ' . $role);
    }

    private static function createUser(string $role): void
    {
        self::requireRole('administrateur');
        $values = self::requireFields(['nom', 'prenom', 'login', 'password', 'solde'], $_POST);
        $id = ModelUtilisateur::create(
            $values['nom'],
            $values['prenom'],
            $role,
            $values['login'],
            $values['password'],
            (float) $values['solde']
        );

        if (!$id) {
            self::message('Ajout impossible', 'Ce login existe deja.', 'warning', 'adminUtilisateurs', 'Voir les utilisateurs');
            return;
        }

        self::message('Utilisateur ajoute', 'Le ' . $role . ' a ete ajoute avec l identifiant ' . $id . '.', 'success', 'adminUtilisateurs', 'Voir les utilisateurs');
    }
}
