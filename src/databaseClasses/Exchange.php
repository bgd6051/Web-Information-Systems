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
    float $TradeVolume24hBtc, int|null $ID_EXCHANGE)  
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

    public static function constructList($result){
        for($i = 0; $i < count($result); $i++){
            $line = $result[$i];
            //obtener los parametros de $line
            $exchange = new Exchange(/*poner los parametros de $line*/);
            $list[$i] = $exchange;
        }
        return $list;
    }
    
    public function getId() {
        return $this->Id;
    }
    public function getName() {
        return $this->Name;
    }
    public function getYearEstablished() {
        return $this->YearEstablished;
    }
    public function getCountry() {
        return $this->Country;
    }
    public function getImage() {
        return $this->Image;
    }
    public function getTrustScore() {
        return $this->TrustScore;
    }
    public function getTradeVolume24hBtc() {
        return $this->TradeVolume24hBtc;
    }
    public function getID_EXCHANGE() {
        return $this->ID_EXCHANGE;
    }
}   