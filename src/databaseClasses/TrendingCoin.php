<?php
class TrendingCoin
{
    private string $Id;
    private string $Name;
    private string $Thumbnail;
    private float $Price;
    private float $PriceChangePercentage24h;
    private int $ID_TRENDING_COIN;

    public function __construct( string $Id, string $Name, string $Thumbnail, float $Price, 
                                float $PriceChangePercentage24h, ?int $ID_TRENDING_COIN = null)  
    {
        $this->$Id = $Id;
        $this->$Name = $Name;
        $this->$Thumbnail = $Thumbnail;
        $this->$Price = $Price;
        $this->$PriceChangePercentage24h = $PriceChangePercentage24h;
        $this->$ID_TRENDING_COIN = $ID_TRENDING_COIN;
    }

    public static function constructTrendingCoinArray(array $responseArray): array{
        $coinArray = $responseArray["coins"];
        $numOfTrendingCoins = count($coinArray);
        $trendingCoinList = [];
        for($i = 0; $i < $numOfTrendingCoins; $i++){
            $trendingCoinLine = $responseArray[$i]["item"];
            $trendingCoin = new TrendingCoin( $trendingCoinLine["id"], $trendingCoinLine["name"],
            $trendingCoinLine["thumb"],$trendingCoinLine["data"]["price"],
            $trendingCoinLine["data"]["PriceChangePercentage_24h"]["usd"] );
            $trendingCoinList[$i] = $trendingCoin;
        }
        return $trendingCoinList;
    }
    public function getId(): string {
        return $this->Id;
    }
    public function getName(): string {
        return $this->Name;
    }
    public function getThumbnail(): string {
        return $this->Thumbnail;
    }
    public function getPrice(): float {
        return $this->Price;
    }
    public function getPriceChangePercentage24h(): float {
        return $this->PriceChangePercentage24h;
    }
    public function getID_TRENDING_COIN(): int {
        return $this->ID_TRENDING_COIN;
    }
}   