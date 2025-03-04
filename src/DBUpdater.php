<?php

class DBUpdater extends DBHandler {
    public function updateCoin($coin) {
        $query = "UPDATE FINAL_COINS SET id = ?, symbol = ?, name = ? WHERE ID_COIN = ?";
        return $this->executeQuery($query, 
            ["issi", $coin->getId(), $coin->getSymbol(),
                    $coin->getName(),
                    $coin->getID_COIN()]);
    }
    public function updateAdminLog($adminLog) {
        $query = "UPDATE FINAL_ADMIN_LOG SET ID_ADMIN = ?, action = ?, fecha = ? WHERE ID_LOG = ?";
        return $this->executeQuery($query, 
            ["issi", $adminLog->getID_ADMIN(), 
                    $adminLog->getAction(), 
                    $adminLog->getFecha(),
                    $adminLog->getID_LOG()] );
    }
    public function updateExchangeRate($exchangeRate) {
        $query = "UPDATE FINAL_EXCHANGE_RATE SET ID_COIN_FORM = ?, 
        ID_COIN_TO = ?, date = ?, price = ? WHERE ID_EXCHANGE = ?";
        return $this->executeQuery($query, 
            ["iisdi", $exchangeRate->getID_COIN_FORM(), 
                    $exchangeRate->getID_COIN_TO(), 
                    $exchangeRate->getDate(), 
                    $exchangeRate->getPrice(),
                    $exchangeRate->getID_EXCHANGE()] );
    }
    public function updateSupportedCoin($supportedCoin) {
        $query = "UPDATE FINAL_SUPPORTED_COINS SET ID_COIN = ? WHERE ID_SUPPORTED = ?";
        return $this->executeQuery($query, 
            ["ii", $supportedCoin->getID_COIN(),
                    $supportedCoin->getID_SUPPORTED()]);
    }
    
    public function updateTrendingCoin($trendingCoin) {
        $query = "UPDATE FINAL_TRENDING_COINS SET ID_COIN = ?, date = ? WHERE ID_TRENDING = ?";
        return $this->executeQuery($query, ["isi", $trendingCoin->getID_COIN(), 
                    $trendingCoin->getDate(),
                    $trendingCoin->getID_TRENDING()] );
    }
        
    
    public function updateUserRegistration($userRegistration) {
        $query = "UPDATE FINAL_USER_REGISTRATION SET username = ?, password = ?, role = ? WHERE ID_USER = ?";
        return $this->executeQuery($query,
         ["sssi", $userRegistration->getUsername(), 
                    $userRegistration->getPassword(), 
                    $userRegistration->getRole(),
                    $userRegistration->getID_USER()]) ;
    }
        
    public function updateExchanges($exchanges) {
        $query = "UPDATE FINAL_EXCHANGES SET id = ?, name = ?, year_established = ?, 
        country = ?, trust_score = ?, trade_volume_24h_btc = ? WHERE ID_EXCHANGE = ?";
        return $this->executeQuery($query,
        ["ssisidi", $exchanges->getId(),
                   $exchanges->getName(), 
                   $exchanges->getYear_established(), 
                   $exchanges->getCountry(), 
                   $exchanges->getTrust_score(), 
                   $exchanges->getTrade_volume_24h_btc(),
                   $exchanges->getID_EXCHANGE()]);
    }
}
