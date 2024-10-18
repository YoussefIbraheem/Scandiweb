<?php 
namespace App;

use PDO;
use PDOException;

class Database extends Singleton
{
    private $host = 'localhost';
    private $dbName = 'scandiweb-products';
    private $username = 'youssef';
    private $password = 'password123';

    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
            $sql = file_get_contents('file.sql');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
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


?>