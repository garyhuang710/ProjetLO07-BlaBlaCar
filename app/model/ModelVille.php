<?php

class ModelVille
{
    public static function getAll(): array
    {
        return Model::select('select id, nom from ville order by nom');
    }

    public static function create(string $nom): int
    {
        $id = Model::nextId('ville');
        Model::execute(
            'insert into ville (id, nom) values (:id, :nom)',
            ['id' => $id, 'nom' => strtolower($nom)]
        );

        return $id;
    }
}
