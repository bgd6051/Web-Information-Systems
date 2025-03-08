<?php

class DBSelector extends DBHandler{

    public function getAllAdminLogs() 
    {
        $query = "SELECT * FROM FINAL_ADMIN_LOG";
        $stmt = $this->executeQuery($query);
        return $stmt->get_result(); 
    }

    public function getAllUserRegistrations() 
    {
        $query = "SELECT * FROM FINAL_USER_REGISTRATION";
        $stmt = $this->executeQuery($query);
        return $stmt->get_result();
    }

    public function getAllExchangeRates() 
    {
        $query = "SELECT * FROM FINAL_EXCHANGE_RATE";
        $stmt = $this->executeQuery($query);
        return $stmt->get_result();
    }

    public function getAllSupportedCoins() 
    {
        $query = "SELECT * FROM FINAL_SUPPORTED_COINS";
        $stmt = $this->executeQuery($query);
        return $stmt->get_result();
    }

    public function getAllTrendingCoins() 
    {
        $query = "SELECT * FROM FINAL_TRENDING_COINS";
        $stmt = $this->executeQuery($query);
        return $stmt->get_result();
    }

    public function getAllCoins() 
    {
        $query = "SELECT * FROM FINAL_COINS";
        $stmt = $this->executeQuery($query);
        return $stmt->get_result();
    }

    public function getAllExchanges() 
    {
        $query = "SELECT * FROM FINAL_EXCHANGES";
        $stmt = $this->executeQuery($query);
        return $stmt->get_result();
    }
}
