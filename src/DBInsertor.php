<?php
class DBInsertor extends DBHandler {
    public function insertCoin($coin) {
        $query = "INSERT INTO FINAL_COINS (id, symbol, name) VALUES (?, ?, ?)";
        return $this->executeQuery($query, ["ss", $coin->getId(), $coin->getSymbol(), $coin->getName()]);
    }
    public function insertAdminLog($adminLog) {
        $query = "INSERT INTO FINAL_ADMIN_LOG (ID_ADMIN, action, fecha) VALUES (?, ?, ?)";
        return $this->executeQuery($query, 
            ["ss", $adminLog->getID_ADMIN(), 
                        $adminLog->getAction(), 
                        $adminLog->getFecha()] );
    }
    public function insertExchangeRate($exchangeRate) {
        $query = "INSERT INTO FINAL_EXCHANGE_RATE (ID_COIN_FORM, ID_COIN_TO, date, price) VALUES (?, ?, ?, ?)";
        return $this->executeQuery($query, ["ss", $exchangeRate->getID_COIN_FORM(), 
                    $exchangeRate->getID_COIN_TO(), 
                    $exchangeRate->getDate(), 
                    $exchangeRate->getPrice()] );
    }
    public function insertSupportedCoin($supportedCoin) {
        $query = "INSERT INTO FINAL_SUPPORTED_COINS (ID_COIN) VALUES (?)";
        return $this->executeQuery($query, ["ss", $supportedCoin->getID_COIN()]);
    }
    public function insertTrendingCoin($trendingCoin) {
        $query = "INSERT INTO FINAL_TRENDING_COINS (ID_COIN, date) VALUES (?, ?)";
        return $this->executeQuery($query, ["ss", $trendingCoin->getID_COIN(), 
                    $trendingCoin->getDate()] );
    }
    public function insertUserRegistration($userRegistration) {
        $query = "INSERT INTO FINAL_USER_REGISTRATION (username, password, role) VALUES (?, ?, ?)";
        return $this->executeQuery($query,
         ["ss", $userRegistration->getUsername(), 
                    $userRegistration->getPassword(), 
                    $userRegistration->getRole()] );
    }
}