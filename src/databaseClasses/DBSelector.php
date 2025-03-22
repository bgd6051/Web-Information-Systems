<?php

class DBSelector extends DBHandler{

    public function selectToArray($select){
        $rownum = 0;
        $Array = [];
        while ($row = $select->fetch_array(MYSQLI_BOTH)) {
            $Array[$rownum] = $row;
            $rownum += 1;
        }
        return $Array;
    }
    public function getAllAdminLogs()  
    {
        $query = "SELECT * FROM FINAL_ADMIN_LOG";
        $stmt = $this->executeQuery($query);
        $selection = $this->selectToArray($stmt->get_result());
        $rownum = 0;
        $structuredSelection = [];
        foreach ($selection as $row) {
            $structuredSelection[$rownum] = new AdminLog(
                $row[1],$row[2],$row[3],$row[0]);
            $rownum += 1;
        }
        return $structuredSelection; 
    }

    public function getAllUserRegistrations() 
    {
        $query = "SELECT * FROM FINAL_USER_REGISTRATION";
        $stmt = $this->executeQuery($query);
        $selection = $this->selectToArray($stmt->get_result());
        $rownum = 0;
        $structuredSelection = [];
        foreach ($selection as $row) {
            $structuredSelection[$rownum] = new UserRegistration(
                $row[1],$row[2],$row[3],$row[0]);
            $rownum += 1;
        }
        return $structuredSelection;
    }

    public function getAllCoinChart() 
    {
        $query = "SELECT * FROM FINAL_COINS_CHART";
        $stmt = $this->executeQuery($query);
        $selection = $this->selectToArray($stmt->get_result());
        $rownum = 0;
        $structuredSelection = [];
        foreach ($selection as $row) {
            $structuredSelection[$rownum] = new CoinChartInstance(
                $row[1],$row[2],$row[3],$row[4],
                $row[5],$row[0]);
            $rownum += 1;
        }
        return $structuredSelection;
    }

    public function getAllTrendingCoins() 
    {
        $query = "SELECT * FROM FINAL_TRENDING_COINS";
        $stmt = $this->executeQuery($query);
        $selection = $this->selectToArray($stmt->get_result());
        $rownum = 0;
        $structuredSelection = [];
        foreach ($selection as $row) {
            $structuredSelection[$rownum] = new TrendingCoin(
                $row[1],$row[2],$row[3],$row[4],
                $row[5],$row[0]);
            $rownum += 1;
        }
        return $structuredSelection;
    }

    public function getAllTrendingNfts() 
    {
        $query = "SELECT * FROM FINAL_TRENDING_NFTS";
        $stmt = $this->executeQuery($query);
        $selection = $this->selectToArray($stmt->get_result());
        $rownum = 0;
        $structuredSelection = [];
        foreach ($selection as $row) {
            $structuredSelection[$rownum] = new TrendingNft(
                $row[1],$row[2],$row[3],$row[4],
                $row[5],$row[6],
                $row[7],$row[0]);
            $rownum += 1;
        }
        return $structuredSelection;
    }

    public function getAllCoins() 
    {
        $query = "SELECT * FROM FINAL_COINS";
        $stmt = $this->executeQuery($query);
        $selection = $this->selectToArray($stmt->get_result());
        $rownum = 0;
        $structuredSelection = [];
        foreach ($selection as $row) {
            $structuredSelection[$rownum] = new Coin(
                $row[1],$row[2],$row[3],$row[4],
                $row[5],$row[6],
                $row[7],$row[0]);
            $rownum += 1;
        }
        return $structuredSelection;
    }

    public function getAllExchanges() 
    {
        $query = "SELECT * FROM FINAL_EXCHANGES";
        $stmt = $this->executeQuery($query);
        $selection = $this->selectToArray($stmt->get_result());
        $rownum = 0;
        $structuredSelection = [];
        foreach ($selection as $row) {
            $structuredSelection[$rownum] = new Exchange(
                $row[1],$row[2],$row[3],$row[4],
                $row[5],$row[6],
                $row[7],$row[0]);
            $rownum += 1;
        }
        return $structuredSelection;
    }
}
