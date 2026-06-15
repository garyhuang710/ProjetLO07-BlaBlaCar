<?php

class Model
{
    private static $pdo = null;

    public static function getPdo(): PDO
    {
        if (self::$pdo === null) {
            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
            self::$pdo = new PDO($dsn, DB_USER, DB_PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }

        return self::$pdo;
    }

    public static function select(string $sql, array $params = []): array
    {
        $statement = self::getPdo()->prepare($sql);
        $statement->execute($params);
        return $statement->fetchAll();
    }

    public static function selectOne(string $sql, array $params = []): ?array
    {
        $statement = self::getPdo()->prepare($sql);
        $statement->execute($params);
        $result = $statement->fetch();
        return $result ?: null;
    }

    public static function execute(string $sql, array $params = []): int
    {
        $statement = self::getPdo()->prepare($sql);
        $statement->execute($params);
        return $statement->rowCount();
    }

    public static function nextId(string $table): int
    {
        $allowed = ['utilisateur', 'vehicule', 'ville', 'trajet', 'reservation'];

        if (!in_array($table, $allowed, true)) {
            throw new InvalidArgumentException('Table non autorisee.');
        }

        $row = self::selectOne('select coalesce(max(id), 0) + 1 as next_id from ' . $table);
        return (int) $row['next_id'];
    }
}
