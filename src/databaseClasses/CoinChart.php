<?php
class CoinChart
{
    private int $ID_COIN;
    private int $UnixTime;
    private float $Price;
    private float $MarketCap;
    private float $TotalVolume;
    private int $ID_COINS_CHART;

    public function __construct(int $ID_COIN, int $UnixTime, float $NaPriceme,
    float $MarketCap, float $TotalVolume, int|null $ID_COINS_CHART)  
    {
        $this->$ID_COIN = $ID_COIN;
        $this->$UnixTime = $UnixTime;
        $this->$Price = $Price;
        $this->$MarketCap = $MarketCap;
        $this->$TotalVolume = $TotalVolume;
        $this->$ID_COINS_CHART = $ID_COINS_CHART;
    }

    public static function constructList($result){
        for($i = 0; $i < count($result); $i++){
            $line = $result[$i];
            //obtener los parametros de $line
            $coinChart = new CoinChart(/*poner los parametros de $line*/);
            $list[$i] = $coinChart;
        }
        return $list;
    }
    public function getID_COIN() {
        return $this->ID_COIN;
    }
    public function getUnixTime() {
        return $this->UnixTime;
    }
    public function getPrice() {
        return $this->Price;
    }
    public function getMarketCap() {
        return $this->MarketCap;
    }
    public function getTotalVolume() {
        return $this->TotalVolume;
    }
    public function getID_COINS_CHART() {
        return $this->ID_COINS_CHART;
    }
}   