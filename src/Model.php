<?php

namespace App;

use PDO;
use App\Database;
use Faker\Factory;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // This method will return the primary key name, defaulting to 'id'
    public static function getKeyName(): string
    {
        return 'id';
    }

    // This method should be implemented by child models
    public static abstract function fromArray(array $dbRecord): Model;

    public abstract function toArray(): array;

    public static function getAll(): array
    {
        $db = Database::getInstance()->getConnection();
        $query = $db->query('SELECT * FROM ' . static::getTable());

        return $query ? $query->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    // This method will return the name of the table
    protected static function getTable(): string
    {
        return substr(strtolower(static::class), 11)  . 's';
    }

    // A simple find method to retrieve a record by its primary key
    public function find(int $id): ?Model
    {
        $query = $this->db->prepare('SELECT * FROM ' . static::getTable() . ' WHERE ' . static::getKeyName() . ' = :id');
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return static::fromArray($result);
        }

        return null;
    }

    public function deleteByIds(array $ids)
{
   $placeholders = implode(',', array_fill(0, count($ids), '?'));
   $sql = "DELETE FROM products WHERE id IN ($placeholders)";
   $stmt = $this->db->prepare($sql);
   $stmt->execute($ids);
}

    public function hasMany(string $relatedModel, string $foreignKey, string $localKey = 'id')
    {
        $related = new $relatedModel;
        $db = Database::getInstance();
        $query = 'SELECT * FROM ' . $related->getTable() . ' WHERE ' . $foreignKey . ' = :localKey';
        return $db->query($query, ['localKey' => $this->{$localKey}])->fetchAll();
    }

    public function belongsTo(string $relatedModel, string $foreignKey, string $ownerKey = 'id')
    {
        $related = new $relatedModel;
        $db = Database::getInstance();
        $query = 'SELECT * FROM ' . $related->getTable() . ' WHERE ' . $ownerKey . ' = :foreignKey';
        return $db->query($query, ['foreignKey' => $this->{$foreignKey}])->fetch();
    }

    // Abstract method to be implemented by child models to create a new record
    protected abstract static function create(array $data);
}
