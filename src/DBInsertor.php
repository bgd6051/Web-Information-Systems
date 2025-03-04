<?php
class DBInsertor extends DBHandler {
    public function insertCoin($coin) {
        $query = "INSERT INTO FINAL_COINS (id, symbol, name) VALUES (?, ?, ?)";
        return $this->executeQuery($query, ["sss", $coin->getId(), $coin->getSymbol(), $coin->getName()]);
    }
    public function insertAdminLog($adminLog) {
        $query = "INSERT INTO FINAL_ADMIN_LOG (ID_ADMIN, action, fecha) VALUES (?, ?, ?)";
        return $this->executeQuery($query, 
            ["iss", $adminLog->getID_ADMIN(), 
                        $adminLog->getAction(), 
                        $adminLog->getFecha()] );
    }
    public function insertExchangeRate($exchangeRate) {
        $query = "INSERT INTO FINAL_EXCHANGE_RATE (ID_COIN_FORM, ID_COIN_TO, date, price) VALUES (?, ?, ?, ?)";
        return $this->executeQuery($query, ["iisd", $exchangeRate->getID_COIN_FORM(), 
                    $exchangeRate->getID_COIN_TO(), 
                    $exchangeRate->getDate(), 
                    $exchangeRate->getPrice()] );
    }
    public function insertSupportedCoin($supportedCoin) {
        $query = "INSERT INTO FINAL_SUPPORTED_COINS (ID_COIN) VALUES (?)";
        return $this->executeQuery($query, ["i", $supportedCoin->getID_COIN()]);
    }
    public function insertTrendingCoin($trendingCoin) {
        $query = "INSERT INTO FINAL_TRENDING_COINS (ID_COIN, date) VALUES (?, ?)";
        return $this->executeQuery($query, ["is", $trendingCoin->getID_COIN(), 
                    $trendingCoin->getDate()] );
    }
    public function insertUserRegistration($userRegistration) {
        $query = "INSERT INTO FINAL_USER_REGISTRATION (username, password, role) VALUES (?, ?, ?)";
        return $this->executeQuery($query,
         ["sss", $userRegistration->getUsername(), 
                    $userRegistration->getPassword(), 
                    $userRegistration->getRole()] );
    }
    public function insertExchanges($exchanges) {
        $query = "INSERT INTO FINAL_EXCHANGES (id, name, year_established, 
        country, trust_score, trade_volume_24h_btc) VALUES (?, ?, ?, ?, ?, ?)";
        return $this->executeQuery($query,
         ["ssisid", $exchanges->getId(),
                    $exchanges->getName(), 
                    $exchanges->getYear_established(), 
                    $exchanges->getCountry(), 
                    $exchanges->getTrust_score(), 
                    $exchanges->getTrade_volume_24h_btc()] );
    }
}