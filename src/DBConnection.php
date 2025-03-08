<?php

class DBConnection 
{
    private static $instance = null;
    private $conn;

    public function __construct()  
    {
        $this->conn = mysqli_connect(HOST, USERNAME,  PASSWORD, DATABASE);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DBConnection();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}   