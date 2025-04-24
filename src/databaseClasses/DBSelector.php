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
    public function getAllAdminLogs($orderBy, $orderReversed)  
    {
        $query = "SELECT * FROM FINAL_ADMIN_LOG";
        $query .= $this->orderBy($orderBy,$orderReversed);
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

    public function getLastAdminLog()  
    {
        $query = "SELECT max(fecha) FROM FINAL_ADMIN_LOG WHERE action = 'RELOAD'";
        $stmt = $this->executeQuery($query);
        $selection = $this->selectToArray($stmt->get_result());
        return $selection;
    }

    public function getAllUserRegistrations($orderBy, $orderReversed,$filtro) 
    {
        $query = "SELECT * FROM FINAL_USER_REGISTRATION";
        $query .= $this->filterLike("username",$filtro);
        $query .= $this->orderBy($orderBy,$orderReversed);
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

    public function getRegisteredUser($username) 
    {
        $query = "SELECT * FROM FINAL_USER_REGISTRATION";
        $query .= " WHERE Username='".$username."'";
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

    public function getAllCoinChart($orderBy, $orderReversed) 
    {
        $query = "SELECT * FROM FINAL_COINS_CHART";
        $query .= $this->orderBy($orderBy,$orderReversed);
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

    public function getCoinChartFromCoinId($coinId) 
    {
        $query = "SELECT * FROM FINAL_COINS_CHART";
        $query .= " WHERE ID_COIN='".$coinId."'";
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

    public function getAllTrendingCoins($orderBy, $orderReversed) 
    {
        $query = "SELECT * FROM FINAL_TRENDING_COINS";
        $query .= $this->orderBy($orderBy,$orderReversed);
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

    public function getAllTrendingNfts($orderBy, $orderReversed) 
    {
        $query = "SELECT * FROM FINAL_TRENDING_NFTS";
        $query .= $this->orderBy($orderBy,$orderReversed);
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

    public function getAllCoins($orderBy, $orderReversed) 
    {
        $query = "SELECT * FROM FINAL_COINS";
        $query .= $this->orderBy($orderBy,$orderReversed);
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

    public function getAllExchanges($orderBy, $orderReversed) 
    {
        $query = "SELECT * FROM FINAL_EXCHANGES";
        $query .= $this->orderBy($orderBy,$orderReversed);
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

    private function orderBy($orderBy, $orderReversed): string{
        if($orderBy == null){
            return "";
        }
        $query = " ORDER BY ".$orderBy;
        if($orderReversed == null){
            return $query;
        }
        if($orderReversed){
            return $query." DESC";
        } 
        return $query." ASC";
    } 

    private function filterLike($filtrado,$filtro){
        if($filtrado == null || $filtro == null){
            return "";
        } 
        return " WHERE ".$filtrado." LIKE '".$filtro."%'";
    } 
}
