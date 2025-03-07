<?php
class Coin
{
    private string $Id;
    private string $Symbol;
    private string $Name;
    private string $Image;
    private int $CurrentPrice;
    private int $MarketCap;
    private float $PriceChangePercentage24h;
    private int $ID_COIN;

    public function __construct(string $Id, string $Symbol, string $Name,
    string $Image, int $CurrentPrice, int $MarketCap, 
    float $PriceChangePercentage24h, int|null $ID_COIN)  
    {
        $this->$Id = $Id;
        $this->$Symbol = $Symbol;
        $this->$Name = $Name;
        $this->$Image = $Image;
        $this->$CurrentPrice = $CurrentPrice;
        $this->$MarketCap = $MarketCap;
        $this->$PriceChangePercentage24h = $PriceChangePercentage24h;
        $this->$ID_COIN = $ID_COIN;
    }

    public static function constructList($result){
        for($i = 0; $i < count($result); $i++){
            $line = $result[$i];
            $coin = new Coin($line["id"],$line["symbol"],$line["name"],
            $line["image"],$line["current_price"],$line["market_cap"],
            $line["price_change_percentage_24h"], null);
            $list[$i] = $coin;
        }
        return $list;
    }
    
    public function getId() {
        return $this->Id;
    }
    public function getSymbol() {
        return $this->Symbol;
    }
    public function getName() {
        return $this->Name;
    }
    public function getImage() {
        return $this->Image;
    }
    public function getCurrentPrice() {
        return $this->CurrentPrice;
    }
    public function getMarketCap() {
        return $this->MarketCap;
    }
    public function getPriceChangePercentage24h() {
        return $this->PriceChangePercentage24h;
    }
    public function getID_COIN() {
        return $this->ID_COIN;
    }
}   