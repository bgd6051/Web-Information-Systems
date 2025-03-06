<?php

class DBUpdater extends DBHandler {
    public function updateCoin(Coin $coin) {
        $query = "UPDATE FINAL_COINS SET id = ?, symbol = ?, name = ?, 
        image = ?, current_price = ?, market_cap = ?, 
        price_change_percentage_24h = ? WHERE ID_COIN = ?";
        return $this->executeQuery($query,
        ["ssssiidi", $coin->getId(),
                    $coin->getSymbol(),
                    $coin->getName(),
                    $coin->getImage(),
                    $coin->getCurrentPrice(),
                    $coin->getMarketCap(),
                    $coin->getPriceChangePercentage24h(),
                    $coin->getID_COIN()]);
    }
    
    public function updateAdminLog(AdminLog $adminLog) {
        $query = "UPDATE FINAL_ADMIN_LOG SET ID_ADMIN = ?, action = ?, fecha = ? WHERE ID_LOG = ?";
        return $this->executeQuery($query, 
            ["issi", $adminLog->getID_ADMIN(), 
                    $adminLog->getAction(), 
                    $adminLog->getFecha(),
                    $adminLog->getID_LOG()]);
    }
    
    public function updateCoinsChart(CoinChart $coinsChart) {
        $query = "UPDATE FINAL_COINS_CHART SET ID_COIN = ?, unix_time = ?, 
        price = ?, market_cap = ?, total_volume = ? WHERE ID_COINS_CHART  = ?";
        return $this->executeQuery($query, 
            ["iidddi", $coinsChart->getID_COIN(), 
                    $coinsChart->getUnixTime(), 
                    $coinsChart->getPrice(), 
                    $coinsChart->getMarketCap(), 
                    $coinsChart->getTotalVolume(), 
                    $coinsChart->getID_COINS_CHART()] );
    }
    
    public function updateTrendingCoin(TrendingCoin $trendingCoin) {
        $query = "UPDATE FINAL_TRENDING_COINS SET id = ?, name = ?, thumbnail = ?, 
        price = ?, price_change_percentage_24h = ? WHERE ID_TRENDING_COIN = ?";
        return $this->executeQuery($query, ["sssddi", $trendingCoin->getId(), 
                    $trendingCoin->getName(), 
                    $trendingCoin->getThumbnail(), 
                    $trendingCoin->getPrice(), 
                    $trendingCoin->getPriceChangePercentage24h(),
                    $trendingCoin->getID_TRENDING_COIN()] );
    }
    
    public function updateTrendingNft(TrendingNft $trendingNft) {
        $query = "UPDATE FINAL_TRENDING_NFTS SET id = ?, name = ?, symbol = ?, 
        thumb = ?, native_currency_symbol = ?, floor_price_in_native_currency = ?
        , floor_price_24h_percentage_change = ? WHERE ID_TRENDING_NFT = ?";
        return $this->executeQuery($query, 
            ["sssssddi", $trendingNft->getId(), 
                    $trendingNft->getName(), 
                    $trendingNft->getSymbol(), 
                    $trendingNft->getThumb(), 
                    $trendingNft->getNativeCurrencySymbol(), 
                    $trendingNft->getFloorPriceInNativeCurrency(), 
                    $trendingNft->getFloorPrice24hPercentageChange(), 
                    $trendingNft->getID_TRENDING_NFT()] );
    }
    
    public function updateUserRegistration(UserRegistration $userRegistration) {
        $query = "UPDATE FINAL_USER_REGISTRATION SET username = ?, password = ?, role = ? WHERE ID_USER = ?";
        return $this->executeQuery($query,
         ["sssi", $userRegistration->getUsername(), 
                    $userRegistration->getPassword(), 
                    $userRegistration->getRole(),
                    $userRegistration->getID_USER()]);
    }
        
    public function updateExchanges(Exchange $exchanges) {
        $query = "UPDATE FINAL_EXCHANGES SET id = ?, name = ?, year_established = ?, 
        country = ?, image = ?, trust_score = ?, trade_volume_24h_btc = ? WHERE ID_EXCHANGE = ?";
        return $this->executeQuery($query, 
            ["ssissidi", $exchanges->getId(), 
                    $exchanges->getName(), 
                    $exchanges->getYearEstablished(), 
                    $exchanges->getCountry(), 
                    $exchanges->getImage(), 
                    $exchanges->getTrustScore(), 
                    $exchanges->getTradeVolume24hBtc(),
                    $exchanges->getID_EXCHANGE()]);
    }

    public function updateAllTables() {
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
        $query = "DELETE FROM FINAL_EXCHANGES";
        $this->executeQuery($query);
    }
}
