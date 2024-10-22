<?php

namespace App;

use PDO;
use PDOException;

abstract class Model
{
    protected $db;
    protected $logger;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        $this->logger = Logger::getInstance();
    }

    public static function getKeyName(): string
    {
        return 'id';
    }

    public static abstract function fromArray(array $dbRecord): Model;

    public abstract function toArray(): array;

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

    protected static function getTable(): string
    {
        return substr(strtolower(static::class), 11) . 's';
    }

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

    protected abstract static function create(array $data);
}
