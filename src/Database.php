<?php 
namespace App;

use PDO;
use PDOException;

class Database extends Singleton
{
    private $host = 'localhost';
    private $dbName = 'scandiweb-db';
    private $username = 'youssef';
    private $password = 'password';

    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {

        $logger = Logger::getInstance();

        try {
            
            $this->connection = new PDO("mysql:host={$this->host}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $result = $this->connection->query("SHOW DATABASES LIKE '{$this->dbName}'");

            if ($result->rowCount() === 0) {

                $sql = file_get_contents('../database/scandiweb-db.sql');
                
                $this->connection->exec($sql);

                $logger->log("Database has been created.");
            }

            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            $logger->log("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
