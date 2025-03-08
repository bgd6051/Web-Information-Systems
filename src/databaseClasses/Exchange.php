<?php
class Exchange
{
    private string $Id;
    private string $Name;
    private int $YearEstablished;
    private string $Country;
    private string $Image;
    private int $TrustScore;
    private float $TradeVolume24hBtc;
    private int $ID_EXCHANGE;
    public function __construct(string $Id, string $Name, int $YearEstablished,
                                string $Country, string $Image, int $TrustScore, 
                                float $TradeVolume24hBtc, ?int $ID_EXCHANGE = null)  
    {
        $this->$Id = $Id;
        $this->$Name = $Name;
        $this->$YearEstablished = $YearEstablished;
        $this->$Country = $Country;
        $this->$Image = $Image;
        $this->$TrustScore = $TrustScore;
        $this->$TradeVolume24hBtc = $TradeVolume24hBtc;
        $this->$ID_EXCHANGE = $ID_EXCHANGE;
    }

    public static function constructList(array $responseArray): array{
        $exchangeList = [];
        $numExchanges = count($responseArray);
        for($i = 0; $i < $numExchanges; $i++) {
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
}   