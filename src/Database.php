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

    /**
     * Class constructor.
     * Initializes database connection parameters from environment variables and attempts to connect to the database.
     */
    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->environment = $_ENV['ENVIRONMENT'];

        $this->connect();
    }

    /**
     * Establish a connection to the database.
     *
     * This function connects to the MySQL database using PDO. If the environment is 'local',
     * it will check if the database exists. If not, it creates the database using an SQL file.
     *
     * @return void
     * @throws PDOException If the connection to the database fails or if an SQL error occurs.
     */
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
            $logger->error("Unexpected error: " . $e->getMessage());
            throw new Exception("Unexpected error: " . $e->getMessage());
        }
    }

    /**
     * Get the established database connection.
     *
     * This method returns the PDO connection to interact with the database. If the connection is not established,
     * it throws an exception.
     *
     * @return PDO The database connection object.
     * @throws PDOException If the database connection is not established.
     */
    public function getConnection()
    {
        if (!$this->connection) {
            throw new PDOException("Database connection is not established.");
        }
        return $this->connection;
    }

    /**
     * Execute a SQL query with optional parameters.
     *
     * This method prepares and executes a SQL query using PDO. If any SQL error occurs, it logs the error and throws an exception.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params Optional parameters to bind to the SQL query.
     * @return \PDOStatement The result of the query execution.
     * @throws PDOException If the query execution fails.
     */
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
