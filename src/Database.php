<?php

namespace App;

use PDO;
use PDOException;
use League\Route\Http\Exception;

class Database extends Singleton
{
    private $host;
    private $dbName;
    private $username;
    private $password;

    private $connection;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'] ?? 'localhost';
        $this->dbName = $_ENV['DB_NAME'] ?? 'default_db';
        $this->username = $_ENV['DB_USER'] ?? 'root';
        $this->password = $_ENV['DB_PASSWORD'] ?? '';

        $this->connect();
    }

    private function connect()
    {
        $logger = Logger::getInstance();

        try {
            // Attempt to connect to the server
            $this->connection = new PDO("mysql:host={$this->host}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if the database exists
            $result = $this->connection->query("SHOW DATABASES LIKE '{$this->dbName}'");

            // If the database doesn't exist, create it
            if ($result->rowCount() === 0) {
                $sql = file_get_contents('../database/scandiweb-db.sql');
                if ($sql === false) {
                    throw new PDOException("SQL file not found.");
                }
                $this->connection->exec($sql);
                $logger->info("Database '{$this->dbName}' has been created.");
            }

            // Connect to the newly created or existing database
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $logger->info("Connected to the database '{$this->dbName}'.");
        } catch (PDOException $e) {
            // Log connection errors
            $logger->error("Database connection failed: " . $e->getMessage());
            throw new PDOException("Connection failed: " . $e->getMessage());
        } catch (Exception $e) {
            // Log any other errors
            $logger->error("Unexpected error: " . $e->getMessage());
            throw new Exception("Unexpected error: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        if (!$this->connection) {
            throw new PDOException("Database connection is not established.");
        }
        return $this->connection;
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            Logger::getInstance()->error("SQL query failed: " . $e->getMessage());
            throw new PDOException("Query execution failed: " . $e->getMessage());
        }
    }
}
