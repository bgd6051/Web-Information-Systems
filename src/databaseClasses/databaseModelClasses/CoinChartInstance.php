<?php

const UNIX_TIME_POSITION = 0;
const CONTENT_POSITION = 1;
class CoinChartInstance
{
    private $ID_COIN;
    private $UnixTime;
    private $Price;
    private $MarketCap;
    private $TotalVolume;
    private $ID_COINS_CHART;

    public function __construct( int $ID_COIN, int $UnixTime, float $Price,
                                float $MarketCap, float $TotalVolume, 
                                ?int $ID_COINS_CHART = null)  
    {
        $this->ID_COIN = $ID_COIN;
        $this->UnixTime = $UnixTime;
        $this->Price = $Price;
        $this->MarketCap = $MarketCap;
        $this->TotalVolume = $TotalVolume;
        $this->ID_COINS_CHART = $ID_COINS_CHART;
    }

    public static function constructCoinChartArray(array $responseArray, int $ID_COIN): array {
        $coinPricesArray = $responseArray["prices"];
        $coinMcapArray = $responseArray["market_caps"];
        $coinVolumeArray = $responseArray["total_volumes"];
        $numberOfRows = count($coinPricesArray);

        $unixInstanceList = [];

        for($i = 0; $i < $numberOfRows; $i++) {
            $unixInstance = $coinPricesArray[$i][UNIX_TIME_POSITION];
            $coinPriceUnixInstance = $coinPricesArray[$i][CONTENT_POSITION];
            $coinMcapUnixInstance = $coinMcapArray[$i][CONTENT_POSITION];
            $coinVolumeUnixInstance = $coinVolumeArray[$i][CONTENT_POSITION];
            
            $coinChartInstance = new CoinChartInstance( $ID_COIN, $unixInstance,  $coinPriceUnixInstance,
                                        $coinMcapUnixInstance, $coinVolumeUnixInstance );
            $unixInstanceList[$i] = $coinChartInstance;
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

    public function toHTML(): string {
        $separador = ", ";
        return "<li>".$this->UnixTime.$separador.$this->Price.$separador.
            $this->MarketCap.$separador.$this->TotalVolume."<li/>";
    }
}   