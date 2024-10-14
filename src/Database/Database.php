<?php 
namespace App\Database;

use PDO;
use PDOException;

class Database
{
    private $host = 'localhost';
    private $dbName = 'scandiweb-products';
    private $username = 'youssef';
    private $password = 'password123';

    private $connection;

    public function __construct()
    {
        $this->connect();
    }App\public\layouts;

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