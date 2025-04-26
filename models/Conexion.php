<?php
include $_SERVER['DOCUMENT_ROOT'] . "/config/database.php";
class Conexion
{
    // Private static instance to ensure singleton behavior
    private static $instance = null;

    // Database configuration
    private $serverName = DB_HOST;
    private $database = DB_NAME;

    // PDO instance for the database connection
    private $db;

    // Private constructor to prevent direct instantiation
    private function __construct()
    {
        try {
            // Establish the database connection using PDO
            $this->db = new PDO(
                "sqlsrv:Server=$this->serverName;Database=$this->database",
                null,
                null,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Enable exceptions for errors
                ]
            );
        } catch (PDOException $e) {
            // Handle connection errors
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Static method to get the single instance of the class
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Conexion(); // Create a new instance if it doesn't exist
        }
        return self::$instance;
    }

    // Method to get the PDO connection object
    public function getConnection()
    {
        return $this->db;
    }

    // Query method to execute SQL queries and return multiple rows
    public function query($sql, $params = [])
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare($sql);

            // Bind parameters if provided
            foreach ($params as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }

            // Execute the statement
            $stmt->execute();

            // Return the results for SELECT queries
            if (stripos($sql, 'SELECT') === 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            // For non-SELECT queries, return the number of affected rows
            return $stmt->rowCount();
        } catch (PDOException $e) {
            // Handle query execution errors
            throw new Exception("Query failed: " . $e->getMessage());
        }
    }

    // QueryOne method to fetch a single row
    public function queryOne($sql, $params = [])
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare($sql);
            
            // Bind parameters if provided
            foreach ($params as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }

            // Execute the statement
            $stmt->execute();

            // Fetch a single row as an associative array
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle query execution errors
            throw new Exception("QueryOne failed: " . $e->getMessage());
        }
    }
}
