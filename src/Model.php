<?php

namespace App;

use PDO;
use PDOException;

abstract class Model
{
    protected $db;
    protected $logger;

    /**
     * Model constructor.
     * Initializes the database connection and logger instance.
     */
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        $this->logger = Logger::getInstance();
    }

    /**
     * Get the primary key name for the model.
     * 
     * @return string The name of the primary key column, defaults to 'id'.
     */
    public static function getKeyName(): string
    {
        return 'id';
    }

    /**
     * Convert a database record into a model instance.
     * 
     * @param array $dbRecord The database record as an associative array.
     * @return Model The model instance.
     */
    public static abstract function fromArray(array $dbRecord): Model;

    /**
     * Convert the model instance into an associative array.
     * 
     * @return array The model data as an associative array.
     */
    public abstract function toArray(): array;

    /**
     * Retrieve all records from the model's associated table.
     * 
     * @return array An array of all records from the table, or an empty array if none found.
     */
    public static function getAll(): array
    {
        try {
            $db = Database::getInstance()->getConnection();
            $query = $db->query('SELECT * FROM ' . static::getTable());
            return $query ? $query->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            Logger::getInstance()->error('Failed to fetch records: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get the associated table name for the model.
     * 
     * @return string The table name based on the class name, assumes plural form.
     */
    protected static function getTable(): string
    {
        return substr(strtolower(static::class), 11) . 's';
    }

    /**
     * Find a record by its primary key.
     * 
     * @param int $id The primary key value.
     * @return Model|null The model instance if found, or null if not.
     */
    public function find(int $id): ?Model
    {
        try {
            $query = $this->db->prepare('SELECT * FROM ' . static::getTable() . ' WHERE ' . static::getKeyName() . ' = :id');
            $query->execute(['id' => $id]);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return static::fromArray($result);
            }
        } catch (PDOException $e) {
            $this->logger->error('Failed to find record by id: ' . $e->getMessage());
        }
        return null;
    }

    /**
     * Delete records with the specified IDs from the model's table.
     * 
     * @param array $ids The array of primary key values to delete.
     * @return void
     */
    public function deleteByIds(array $ids)
    {
        try {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $sql = "DELETE FROM products WHERE id IN ($placeholders)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($ids);
        } catch (PDOException $e) {
            $this->logger->error('Failed to delete records: ' . $e->getMessage());
        }
    }

    /**
     * Define a one-to-many relationship.
     * 
     * @param string $relatedModel The related model class.
     * @param string $foreignKey The foreign key in the related model's table.
     * @param string $localKey The local key in the current model's table, defaults to 'id'.
     * @return array The related records as an array.
     */
    public function hasMany(string $relatedModel, string $foreignKey, string $localKey = 'id')
    {
        try {
            $related = new $relatedModel;
            $query = 'SELECT * FROM ' . $related->getTable() . ' WHERE ' . $foreignKey . ' = :localKey';
            $stmt = $this->db->prepare($query);
            $stmt->execute(['localKey' => $this->{$localKey}]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->logger->error('Failed to fetch related records (hasMany): ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Define a belongs-to relationship.
     * 
     * @param string $relatedModel The related model class.
     * @param string $foreignKey The foreign key in the current model's table.
     * @param string $ownerKey The primary key in the related model's table, defaults to 'id'.
     * @return array|null The related record, or null if not found.
     */
    public function belongsTo(string $relatedModel, string $foreignKey, string $ownerKey = 'id')
    {
        try {
            $related = new $relatedModel;
            $query = 'SELECT * FROM ' . $related->getTable() . ' WHERE ' . $ownerKey . ' = :foreignKey';
            $stmt = $this->db->prepare($query);
            $stmt->execute(['foreignKey' => $this->{$foreignKey}]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            $this->logger->error('Failed to fetch related record (belongsTo): ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Abstract method to create a new record in the database.
     * 
     * @param array $data The data to insert into the table.
     * @return void
     */
    protected abstract static function create(array $data);
}
