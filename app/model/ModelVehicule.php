<?php

class ModelVehicule
{
    public static function getAllWithOwners(): array
    {
        return Model::select(
            'select v.marque, v.modele, v.annee, v.immatriculation,
                    concat(u.prenom, " ", u.nom) as proprietaire
             from vehicule v
             join utilisateur u on u.id = v.proprietaire_id
             order by u.nom, u.prenom, v.marque, v.modele'
        );
    }

    public static function getByOwner(int $ownerId): array
    {
        return Model::select(
            'select id, marque, modele, annee, immatriculation
             from vehicule
             where proprietaire_id = :owner_id
             order by marque, modele',
            ['owner_id' => $ownerId]
        );
    }

    public static function belongsToOwner(int $id, int $ownerId): bool
    {
        return (bool) Model::selectOne(
            'select id from vehicule where id = :id and proprietaire_id = :owner_id',
            ['id' => $id, 'owner_id' => $ownerId]
        );
    }

    public static function create(string $marque, string $modele, int $annee, string $immatriculation, int $proprietaireId): int
    {
        $id = Model::nextId('vehicule');
        Model::execute(
            'insert into vehicule (id, marque, modele, annee, immatriculation, proprietaire_id)
             values (:id, :marque, :modele, :annee, :immatriculation, :proprietaire_id)',
            [
                'id' => $id,
                'marque' => strtolower($marque),
                'modele' => $modele,
                'annee' => $annee,
                'immatriculation' => strtolower($immatriculation),
                'proprietaire_id' => $proprietaireId,
            ]
        );

        return $id;
    }
}
