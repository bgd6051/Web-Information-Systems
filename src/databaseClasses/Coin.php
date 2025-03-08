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

    public function __construct( string $Id, string $Symbol, string $Name,
                                string $Image, int $CurrentPrice, int $MarketCap, 
                                float $PriceChangePercentage24h, ?int $ID_COIN = null)
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
    

    public static function constructCoinArray(array $responseArray): array {
        $coinList = [];
        $numCoins = count($responseArray);
        for ($i = 0; $i < $numCoins; $i++) {
            $coinLine = $responseArray[$i];
            if (in_array($coinLine["id"], MAIN_COINS_ID)) {
                $coin = new Coin(
                    $coinLine["id"],
                    $coinLine["symbol"],
                    $coinLine["name"],
                    $coinLine["image"],
                    $coinLine["current_price"],
                    $coinLine["market_cap"],
                    $coinLine["price_change_percentage_24h"]
                );
                $coinList[] = $coin;
            }
        }
        return $coinList;
    }
    
    
    public function getId(): string {
        return $this->Id;
    }

    public function getSymbol(): string {
        return $this->Symbol;
    }

    public function getName(): string {
        return $this->Name;
    }

    public function getImage(): string {
        return $this->Image;
    }

    public function getCurrentPrice(): int {
        return $this->CurrentPrice;
    }

    public function getMarketCap(): int {
        return $this->MarketCap;
    }

    public function getPriceChangePercentage24h(): float {
        return $this->PriceChangePercentage24h;
    }

    public function getID_COIN(): int {
        return $this->ID_COIN;
    }
}   