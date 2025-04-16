<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Constants.php";
class Coin
{
    private $Id;
    private $Symbol;
    private $Name;
    private $Image;
    private $CurrentPrice;
    private $MarketCap;
    private $PriceChangePercentage24h;
    private $ID_COIN;

    public function __construct( string $Id, string $Symbol, string $Name,
                                string $Image, int $CurrentPrice, int $MarketCap, 
                                float $PriceChangePercentage24h, ?int $ID_COIN = null)
    {
        $this->Id = $Id;
        $this->Symbol = $Symbol;
        $this->Name = $Name;
        $this->Image = $Image;
        $this->CurrentPrice = $CurrentPrice;
        $this->MarketCap = $MarketCap;
        $this->PriceChangePercentage24h = $PriceChangePercentage24h;
        $this->ID_COIN = $ID_COIN;
    }

    public static function constructCoinArray(array $responseArray): array {
        $coinList = [];
        foreach ($responseArray as $iValue) {
            $coinLine = $iValue;
            if (in_array($coinLine["id"], MAIN_COINS_ID)) {
                $coin = new Coin(
                    $coinLine["id"],
                    $coinLine["symbol"],
                    $coinLine["name"],
                    $coinLine["image"],
                    $coinLine["current_price"],
                    $coinLine["market_cap"],
                    $coinLine["price_change_percentage_24h"],
                    MAIN_COINS_ID_INT[$coinLine["id"]]
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

    public function titleHTML(): string {
        $separador = ", ";
        return "<li class='listingsHeader'>Id".$separador."Symbol".$separador."Name".$separador."Image".$separador.
        "CurrentPrice (dollars)".$separador."MarketCap".$separador."PriceChangePercentage24h (%)</li>";
    }

    public function toHTML(): string {
        $separador = ", ";
        $height = "50px";
        $width = "50px";
        $img = '<img src="'.$this->Image.'" height="'.$height.'" width="'.$width.'"/>';
        return "<li>".$this->Id.$separador.$this->Symbol.$separador.
            $this->Name.$separador.$img.$separador.$this->CurrentPrice.$separador.
            $this->MarketCap.$separador.$this->PriceChangePercentage24h."</li>";
    }
}
