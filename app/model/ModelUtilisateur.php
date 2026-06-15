<?php

class ModelUtilisateur
{
    public static function getAll(): array
    {
        return Model::select('select id, nom, prenom, role, login, solde from utilisateur order by role, nom, prenom');
    }

    public static function getById(int $id): ?array
    {
        return Model::selectOne('select id, nom, prenom, role, login, solde from utilisateur where id = :id', [
            'id' => $id,
        ]);
    }

    public static function getByRole(string $role): array
    {
        return Model::select('select id, nom, prenom, login, solde from utilisateur where role = :role order by nom, prenom', [
            'role' => $role,
        ]);
    }

    public static function authenticate(string $login, string $password): ?array
    {
        return Model::selectOne(
            'select id, nom, prenom, role, login, solde from utilisateur where login = :login and password = :password',
            ['login' => $login, 'password' => $password]
        );
    }

    public static function getByLogin(string $login): ?array
    {
        return Model::selectOne('select id from utilisateur where login = :login', [
            'login' => $login,
        ]);
    }

    public static function create(string $nom, string $prenom, string $role, string $login, string $password, float $solde)
    {
        if (self::getByLogin($login)) {
            return false;
        }

        $id = Model::nextId('utilisateur');
        Model::execute(
            'insert into utilisateur (id, nom, prenom, role, login, password, solde)
             values (:id, :nom, :prenom, :role, :login, :password, :solde)',
            [
                'id' => $id,
                'nom' => strtoupper($nom),
                'prenom' => $prenom,
                'role' => $role,
                'login' => $login,
                'password' => $password,
                'solde' => $solde,
            ]
        );

        return $id;
    }
}
