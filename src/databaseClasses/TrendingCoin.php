<?php
class TrendingCoin
{
    private string $Id;
    private string $Name;
    private string $Thumbnail;
    private float $Price;
    private float $PriceChangePercentage24h;
    private int $ID_TRENDING_COIN;

    public function __construct(string $Id, string $Name,
    string $Thumbnail, float $Price, 
    float $PriceChangePercentage24h, int|null $ID_TRENDING_COIN)  
    {
        $this->$Id = $Id;
        $this->$Name = $Name;
        $this->$Thumbnail = $Thumbnail;
        $this->$Price = $Price;
        $this->$PriceChangePercentage24h = $PriceChangePercentage24h;
        $this->$ID_TRENDING_COIN = $ID_TRENDING_COIN;
    }

    public static function constructList($result){
        $elementos = $result["coins"];
        for($i = 0; $i < count($elementos); $i++){
            $line = $result[$i]["item"];
            $trendingCoin = new TrendingCoin($line["id"],$line["name"],
            $line["thumb"],$line["data"]["price"],
            $line["data"]["PriceChangePercentage_24h"]["usd"],
             null);
            $list[$i] = $trendingCoin;
        }
        return $list;
    }
    public function getId() {
        return $this->Id;
    }
    public function getName() {
        return $this->Name;
    }
    public function getThumbnail() {
        return $this->Thumbnail;
    }
    public function getPrice() {
        return $this->Price;
    }
    public function getPriceChangePercentage24h() {
        return $this->PriceChangePercentage24h;
    }
    public function getID_TRENDING_COIN() {
        return $this->ID_TRENDING_COIN;
    }
}   