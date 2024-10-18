<?php

namespace App;
use PDO;
use App\Database;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // This method will return the primary key name, defaulting to 'id'
    public static function getKeyName(): string {
        return 'id';
    }

    // This method should be implemented by child models
    public static abstract function fromArray(array $dbRecord): Model;

    // This method will return the name of the table
    protected static function getTable(): string {
        return strtolower(static::class) . 's';
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

    // Abstract method to be implemented by child models to create a new record
    protected abstract static function create(array $data);
}
