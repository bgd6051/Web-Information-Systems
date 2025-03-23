<?php
abstract class DBHandler 
{
    protected $conn;

    public function __construct() 
    {
        $this->conn = DBConnection::getInstance()->getConnection();
    }

    protected function executeQuery($query, ?array $params = [])    
    {
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("SQL Error: " . $this->conn->error);
        }

        if (!empty($params)) {
            $stmt->bind_param(...$params);
        }

        $responseCode = $stmt->execute();
       
        if ($stmt->field_count > 0) {
            return $stmt;
        }
        
        if ($responseCode === false) {
            echo "Error en la ejecución de la consulta: " . $stmt->error . "<br>";
        }
        
        return $responseCode;
    }
    public function hasQueryExecutedSuccessfully($stmtOrBool): bool 
    {
        if ($stmtOrBool instanceof mysqli_stmt) {
            return $stmtOrBool->affected_rows >= 0; 
        }
        return $stmtOrBool === true;
    }
}
