<?php
abstract class DBHandler 
{
    protected $conn;

    public function __construct() 
    {
        $this->conn = DBConnection::getInstance()->getConnection();
    }

    protected function executeQuery($query, $params = []) 
    {
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("SQL Error: " . $this->conn->error);
        }

        if (!empty($params)) {
            $stmt->bind_param(...$params);
        }

        $stmt->execute();
        return $stmt;
    }
    public function isQuerySuccessful($stmt): bool 
    {
        if ($stmt instanceof mysqli_stmt) {
            if ($stmt->field_count > 0) { return true; } 
            return $stmt->affected_rows >= 0;
        }
        return false;
    }

}
