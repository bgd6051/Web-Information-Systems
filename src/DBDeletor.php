<?php

class DBDeletor extends DBHandler {
    /*
    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        return $this->executeQuery($query, ["i", $id]);
    }*/
    public function deleteAll() {
        $query = "DELETE FROM FINAL_ADMIN_LOG";
        $this->executeQuery($query);
        $query = "DELETE FROM FINAL_EXCHANGE_RATE";
        $this->executeQuery($query);
        $query = "DELETE FROM FINAL_SUPPORTED_COINS";
        $this->executeQuery($query);
        $query = "DELETE FROM FINAL_TRENDING_COINS";
        $this->executeQuery($query);
        $query = "DELETE FROM FINAL_COINS";
        $this->executeQuery($query);
        $query = "DELETE FROM FINAL_USER_REGISTRATION";
        $this->executeQuery($query);
    }
}
