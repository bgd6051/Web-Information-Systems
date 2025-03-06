<?php
class DBInsertor extends DBHandler {
    public function insertCoin(Coin $coin) {
        $query = "INSERT INTO FINAL_COINS (id, symbol, name, 
        image, current_price, market_cap, price_change_percentage_24h) VALUES (?, ?, ?, ?, ?, ?, ?)";
        return $this->executeQuery($query,
        ["ssssiid", $coin->getId(),
                    $coin->getSymbol(),
                    $coin->getName(),
                    $coin->getImage(),
                    $coin->getCurrentPrice(),
                    $coin->getMarketCap(),
                    $coin->getPriceChangePercentage24h()]);
    }
    public function insertAdminLog(AdminLog $adminLog) {
        $query = "INSERT INTO FINAL_ADMIN_LOG (ID_ADMIN, action, fecha) VALUES (?, ?, ?)";
        return $this->executeQuery($query, 
            ["iss", $adminLog->getID_ADMIN(), 
                    $adminLog->getAction(), 
                    $adminLog->getFecha()] );
    }
    public function insertExchanges(Exchange $exchanges) {
        $query = "INSERT INTO FINAL_EXCHANGES (id, name, year_established, 
        country, image, trust_score, trade_volume_24h_btc) VALUES (?, ?, ?, ?, ?, ?, ?)";
        return $this->executeQuery($query, 
            ["ssissid", $exchanges->getId(), 
                    $exchanges->getName(), 
                    $exchanges->getYearEstablished(), 
                    $exchanges->getCountry(), 
                    $exchanges->getImage(), 
                    $exchanges->getTrustScore(), 
                    $exchanges->getTradeVolume24hBtc()]);
    }
    public function insertTrendingCoin(TrendingCoin $trendingCoin) {
        $query = "INSERT INTO FINAL_TRENDING_COINS (id, name, thumbnail 
        , price, price_change_percentage_24h) VALUES (?, ?, ?, ?, ?)";
        return $this->executeQuery($query, ["sssdd", $trendingCoin->getid(), 
                    $trendingCoin->getName(), 
                    $trendingCoin->getThumbnail(), 
                    $trendingCoin->getPrice(), 
                    $trendingCoin->getPriceChangePercentage24h()]);
    }

    public function insertTrendingNft(TrendingNft $trendingNft) {
        $query = "INSERT INTO FINAL_TRENDING_NFTS (id, name, symbol, 
        thumb, native_currency_symbol, floor_price_in_native_currency, floor_price_24h_percentage_change) VALUES (?, ?, ?, ?, ?, ?, ?)";
        return $this->executeQuery($query, 
            ["sssssdd", $trendingNft->getId(), 
                    $trendingNft->getName(), 
                    $trendingNft->getSymbol(), 
                    $trendingNft->getThumb(), 
                    $trendingNft->getNativeCurrencySymbol(), 
                    $trendingNft->getFloorPriceInNativeCurrency(), 
                    $trendingNft->getFloorPrice24hPercentageChange()]);
    }					
    public function insertUserRegistration(UserRegistration $userRegistration) {
        $query = "INSERT INTO FINAL_USER_REGISTRATION (username, password, role) VALUES (?, ?, ?)";
        return $this->executeQuery($query,
         ["sss", $userRegistration->getUsername(), 
                    $userRegistration->getPassword(), 
                    $userRegistration->getRole()] );
    }
    public function insertCoinsChart(CoinChart $coinsChart) {
        $query = "INSERT INTO FINAL_COINS_CHART (ID_COIN, unix_time, price, 
        market_cap, total_volume) VALUES (?, ?, ?, ?, ?)";
        return $this->executeQuery($query, 
            ["iiddd", $coinsChart->getID_COIN(), 
                    $coinsChart->getUnixTime(), 
                    $coinsChart->getPrice(), 
                    $coinsChart->getMarketCap(), 
                    $coinsChart->getTotalVolume()] );
    }

}