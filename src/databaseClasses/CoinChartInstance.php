<?php

const UNIX_TIME_POSITION = 1;
class CoinChartInstance
{
    private int $ID_COIN;
    private int $UnixTime;
    private float $Price;
    private float $MarketCap;
    private float $TotalVolume;
    private int $ID_COINS_CHART;

    public function __construct( int $ID_COIN, int $UnixTime, float $Price,
                                float $MarketCap, float $TotalVolume, 
                                ?int $ID_COINS_CHART = null )  
    {
        $this->$ID_COIN = $ID_COIN;
        $this->$UnixTime = $UnixTime;
        $this->$Price = $Price;
        $this->$MarketCap = $MarketCap;
        $this->$TotalVolume = $TotalVolume;
        $this->$ID_COINS_CHART = $ID_COINS_CHART;
    }

    public static function constructList(array $responseArray, int $ID_COIN): array {
        $coinPricesArray = $responseArray["prices"];
        $coinMcapArray = $responseArray["market_caps"];
        $coinVolumeArray = $responseArray["total_volumes"];
        $numberOfRows = count($coinPricesArray);

        $unixInstanceList = [];

        for($i = 0; $i < $numberOfRows; $i++) {
            $unixInstance = $coinPricesArray[$i][UNIX_TIME_POSITION];
            $coinPriceUnixInstance = $coinPricesArray[$i];
            $coinMcapUnixInstance = $coinMcapArray[$i];
            $coinVolumeUnixInstance = $coinVolumeArray[$i];
            
            $coinChart = new CoinChartInstance( $ID_COIN, $unixInstance,  $coinPriceUnixInstance,
                                        $coinMcapUnixInstance, $coinVolumeUnixInstance );
            $unixInstanceList[$i] = $coinChart;
        }
        return $unixInstanceList;
    }

    public function getID_COIN(): int {
        return $this->ID_COIN;
    }

    public function getUnixTime(): int {
        return $this->UnixTime;
    }

    public function getPrice(): float {
        return $this->Price;
    }

    public function getMarketCap(): float {
        return $this->MarketCap;
    }

    public function getTotalVolume(): float {
        return $this->TotalVolume;
    }

    public function getID_COINS_CHART(): int {
        return $this->ID_COINS_CHART;
    }
}   