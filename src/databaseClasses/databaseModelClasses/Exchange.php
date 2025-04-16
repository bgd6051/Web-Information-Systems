<?php
class Exchange
{
    private $Id;
    private $Name;
    private $YearEstablished;
    private $Country;
    private $Image;
    private $TrustScore;
    private $TradeVolume24hBtc;
    private $ID_EXCHANGE;
    public function __construct(string $Id, string $Name, ?int $YearEstablished = null,
                                ?string $Country = null, ?string $Image = null, ?int $TrustScore = null, 
                                ?float $TradeVolume24hBtc = null, ?int $ID_EXCHANGE = null)  
    {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->YearEstablished = $YearEstablished;
        $this->Country = $Country;
        $this->Image = $Image;
        $this->TrustScore = $TrustScore;
        $this->TradeVolume24hBtc = $TradeVolume24hBtc;
        $this->ID_EXCHANGE = $ID_EXCHANGE;
    }

    public static function constructExchangeArray(array $responseArray): array{
        $exchangeList = [];
        for($i = 0; $i < 10; $i++) {
            $exchangeLine = $responseArray[$i];
            $exchange = new Exchange( $exchangeLine["id"],$exchangeLine["name"],$exchangeLine["year_established"],
            $exchangeLine["country"],$exchangeLine["image"],$exchangeLine["trust_score"],
            $exchangeLine["trade_volume_24h_btc"] );
            $exchangeList[$i] = $exchange;
        }
        return $exchangeList;
    }
    
    public function getId(): string {
        return $this->Id;
    }

    public function getName(): string {
        return $this->Name;
    }

    public function getYearEstablished(): int {
        return $this->YearEstablished;
    }

    public function getCountry(): string {
        return $this->Country;
    }

    public function getImage(): string {
        return $this->Image;
    }

    public function getTrustScore(): int {
        return $this->TrustScore;
    }

    public function getTradeVolume24hBtc(): float {
        return $this->TradeVolume24hBtc;
    }

    public function getID_EXCHANGE(): int {
        return $this->ID_EXCHANGE;
    }

    public function titleHTML(): string {
        $separador = ", ";
        return "<li>Id".$separador."Name".$separador.
            "YearEstablished".$separador."Country".$separador."Image".$separador.
            "TrustScore".$separador."TradeVolume24hBtc</li>";
    }

    public function toHTML(): string {
        $separador = ", ";
        $height = "50px";
        $width = "50px";
        $img = '<img src="'.$this->Image.'" height="'.$height.'" width="'.$width.'"/>';
        return "<li>".$this->Id.$separador.$this->Name.$separador.
            $this->YearEstablished.$separador.$this->Country.$separador.$img.$separador.
            $this->TrustScore.$separador.$this->TradeVolume24hBtc."</li>";
    }
}   