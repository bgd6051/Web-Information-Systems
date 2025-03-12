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

    public function getAllCoinChart() 
    {
        $query = "SELECT * FROM FINAL_COINS_CHART";
        $stmt = $this->executeQuery($query);
        return $stmt->get_result();
    }

    public function getAllTrendingCoins() 
    {
        $query = "SELECT * FROM FINAL_TRENDING_COINS";
        $stmt = $this->executeQuery($query);
        return $stmt->get_result();
    }

    public function getAllTrendingNfts() 
    {
        $query = "SELECT * FROM FINAL_TRENDING_NFTS";
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
