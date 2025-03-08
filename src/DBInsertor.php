<?php
class DBInsertor extends DBHandler {
    
    public function insertCoin(Coin $coin) {
        $query = "INSERT INTO FINAL_COINS (id, symbol, name, 
                image, current_price, market_cap, 
                price_change_percentage_24h) VALUES (?, ?, ?, ?, ?, ?, ?)";

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

    public function insertExchange(Exchange $exchange) {
        $query = "INSERT INTO FINAL_EXCHANGES (id, name, year_established, 
        country, image, trust_score, trade_volume_24h_btc) VALUES (?, ?, ?, ?, ?, ?, ?)";
        return $this->executeQuery($query, 
            ["ssissid", $exchange->getId(), 
                    $exchange->getName(), 
                    $exchange->getYearEstablished(), 
                    $exchange->getCountry(), 
                    $exchange->getImage(), 
                    $exchange->getTrustScore(), 
                    $exchange->getTradeVolume24hBtc()]);
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
                thumb, native_currency_symbol, floor_price_in_native_currency,
                floor_price_24h_percentage_change) VALUES (?, ?, ?, ?, ?, ?, ?)";
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

    public function insertCoinChartInstance(CoinChartInstance $coinsChartInstance) {
        $query = "INSERT INTO FINAL_COINS_CHART (ID_COIN, unix_time, price, 
                market_cap, total_volume) VALUES (?, ?, ?, ?, ?)";
        return $this->executeQuery($query, 
            ["iiddd", $coinsChartInstance->getID_COIN(), 
                    $coinsChartInstance->getUnixTime(), 
                    $coinsChartInstance->getPrice(), 
                    $coinsChartInstance->getMarketCap(), 
                    $coinsChartInstance->getTotalVolume()] );
    }

    public function insertCoinChart(array $coinChart): bool {
        foreach ($coinChart as $coinChartInstance) {
            $queryResponse = $this->insertCoinChartInstance(coinsChartInstance: $coinChartInstance);
            if (!$this->isQuerySuccessful($queryResponse)) { return false; }
        }
        return true;
    }

    public function insertAllCoins (array $coins): bool {
        foreach ($coins as $coin) {
            $queryResponse = $this->insertCoin($coin);
            if (!$this->isQuerySuccessful($queryResponse)) { return false; }
        }
        return true;
    }
    
    public function insertAllCoinCharts(array $coinCharts): bool {
        foreach ($coinCharts as $coinChart) {
            $queryResponse = $this->insertCoinChart($coinChart);
            if (!$this->isQuerySuccessful($queryResponse)) { return false; }
        }
        return true;
    }

    public function insertAllExchanges (array $exchanges): bool {
        foreach ($exchanges as $exchange) {
            $queryResponse = $this->insertExchange($exchange);
            if (!$this->isQuerySuccessful($queryResponse)) { return false; }
        }
        return true;
    }

    public function insertAllTrendingCoins (array $trendingCoins): bool {
        foreach ($trendingCoins as $trendingCoin) {
            $queryResponse = $this->insertTrendingCoin($trendingCoin);
            if (!$this->isQuerySuccessful($queryResponse)) { return false; }
        }
        return true;
    }

    public function insertAllTrendingNfts (array $trendingNfts): bool {
        foreach ($trendingNfts as $trendingNft) {
            $queryResponse = $this->insertTrendingNft($trendingNft);
            if (!$this->isQuerySuccessful($queryResponse)) { return false; }
        }
        return true;
    }

    public function insertAllInformation(array $tableElements): bool {
        
        $coins = $tableElements["coins"];
        if (isset($tableElements["coins"])) {
            $queryResponse = $this->insertAllCoins($coins);
            if (!$this->isQuerySuccessful($queryResponse)) { return false; }
        } else { return false; }

        $coinCharts = $tableElements["coinCharts"];
        if (isset($coinCharts)) {
            $queryResponse = $this->insertAllCoinCharts($coinCharts);
            if (!$this->isQuerySuccessful($queryResponse)) { return false; }
        } else { return false; }

        $exchanges = $tableElements["exchanges"];
        if (isset($exchanges)) {
            $queryResponse = $this->insertAllExchanges($exchanges);
            if (!$this->isQuerySuccessful($queryResponse)) { return false; }
        } else { return false; }

        $trendingCoins = $tableElements["trendingCoins"];
        if (isset($trendingCoins)) {
            $queryResponse = $this->insertAllTrendingCoins($trendingCoins);
            if (!$this->isQuerySuccessful($queryResponse)) { return false; }
        } else { return false; }

        $trendingNfts = $tableElements["trendingNfts"];
        if (isset($trendingNfts)) {
            $queryResponse = $this->insertAllTrendingNfts($trendingNfts);
            if (!$this->isQuerySuccessful($queryResponse)) { return false; }
        } else { return false; }

        return true;
    }
}