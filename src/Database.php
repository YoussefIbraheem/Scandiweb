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
    private $environment;

    private $connection;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->environment = $_ENV['ENVIRONMENT'];

        $this->connect();
    }

    private function connect()
    {
        $logger = Logger::getInstance();

        try {
            $this->connection = new PDO("mysql:host={$this->host}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            if ($this->environment === 'local') {

                $result = $this->connection->query("SHOW DATABASES LIKE '{$this->dbName}'");

                if ($result->rowCount() === 0) {
                    $sql = file_get_contents('../database/scandiweb-db.sql');
                    if ($sql === false) {
                        throw new PDOException("SQL file not found.");
                    }
                    $this->connection->exec($sql);
                    $logger->info("Database '{$this->dbName}' has been created.");
                }
            }

            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $logger->info("Connected to the database '{$this->dbName}'.");
        } catch (PDOException $e) {

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
