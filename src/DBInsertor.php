<?php
class DBInsertor extends DBHandler {
    public function insertUser($name, $email) {
        $query = "INSERT INTO users (name, email) VALUES (?, ?)";
        return $this->executeQuery($query, ["ss", $name, $email]);
    }
}