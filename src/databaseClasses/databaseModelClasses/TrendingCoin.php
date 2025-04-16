<?php
class TrendingCoin
{
    private $Id;
    private $Name;
    private $Thumbnail;
    private $Price;
    private $PriceChangePercentage24h;
    private $ID_TRENDING_COIN;

    public function __construct(
        string $Id,
        string $Name,
        ?string $Thumbnail = null,
        ?float $Price = null,
        ?float $PriceChangePercentage24h = null,
        ?int $ID_TRENDING_COIN = null
    ) {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->Thumbnail = $Thumbnail;
        $this->Price = $Price;
        $this->PriceChangePercentage24h = $PriceChangePercentage24h;
        $this->ID_TRENDING_COIN = $ID_TRENDING_COIN;
    }

    public static function constructTrendingCoinArray(array $responseArray): array
    {
        $coinArray = $responseArray["coins"];
        $numOfTrendingCoins = count($coinArray);
        $trendingCoinList = [];

        for ($i = 0; $i < $numOfTrendingCoins; $i++) {
            $trendingCoinLine = $coinArray[$i]["item"];
            $trendingCoin = new TrendingCoin(
                $trendingCoinLine["id"],
                $trendingCoinLine["name"],
                $trendingCoinLine["thumb"],
                $trendingCoinLine["data"]["price"],
                $trendingCoinLine["data"]["price_change_percentage_24h"]["usd"]
            );
            $trendingCoinList[$i] = $trendingCoin;
        }
        return $trendingCoinList;
    }
    public function getId(): string
    {
        return $this->Id;
    }
    public function getName(): string
    {
        return $this->Name;
    }
    public function getThumbnail(): string
    {
        return $this->Thumbnail;
    }
    public function getPrice(): float
    {
        return $this->Price;
    }
    public function getPriceChangePercentage24h(): float
    {
        return $this->PriceChangePercentage24h;
    }
    public function getID_TRENDING_COIN(): int
    {
        return $this->ID_TRENDING_COIN;
    }

    public function titleHTML(): string
    {
        $separador = ", ";
        return "<li class='listingsHeader'>
            Id" . $separador . "Name" . $separador .
            "Thumbnail" . $separador . "Price (dollars)" . $separador .
            "PriceChangePercentage24h (%)</li>";
    }

    public function toHTML(): string
    {
        $separador = ", ";
        $height = "50px";
        $width = "50px";
        $img = '<img src="' . $this->Thumbnail . '" height="' . $height . '" width="' . $width . '"/>';
        return "<li>" . $this->Id . $separador . $this->Name . $separador . $img . $separador .
            $this->Price . $separador . $this->PriceChangePercentage24h . "</li>";
    }
}