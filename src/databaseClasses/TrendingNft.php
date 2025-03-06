<?php
class TrendingNft
{
    private string $Id;
    private string $Name;
    private string $Symbol;
    private string $Thumb;
    private string $NativeCurrencySymbol;
    private float $FloorPriceInNativeCurrency;
    private float $FloorPrice24hPercentageChange;
    private int $ID_TRENDING_NFT;

    public function __construct(string $Id, string $Name, string $Symbol,
    string $Thumb, string $NativeCurrencySymbol, float $FloorPriceInNativeCurrency, 
    float $FloorPrice24hPercentageChange, int|null $ID_TRENDING_NFT)  
    {
        $this->$Id = $Id;
        $this->$Name = $Name;
        $this->$Symbol = $Symbol;
        $this->$Thumb = $Thumb;
        $this->$NativeCurrencySymbol = $NativeCurrencySymbol;
        $this->$FloorPriceInNativeCurrency = $FloorPriceInNativeCurrency;
        $this->$FloorPrice24hPercentageChange = $FloorPrice24hPercentageChange;
        $this->$ID_TRENDING_NFT = $ID_TRENDING_NFT;
    }

    public static function constructList($result){
        for($i = 0; $i < count($result); $i++){
            $line = $result[$i];
            //obtener los parametros de $line
            $trendingNft = new TrendingNft(/*poner los parametros de $line*/);
            $list[$i] = $trendingNft;
        }
        return $list;
    }
    public function getId() {
        return $this->Id;
    }
    public function getName() {
        return $this->Name;
    }
    public function getSymbol() {
        return $this->Symbol;
    }
    public function getThumb() {
        return $this->Thumb;
    }
    public function getNativeCurrencySymbol() {
        return $this->NativeCurrencySymbol;
    }
    public function getFloorPriceInNativeCurrency() {
        return $this->FloorPriceInNativeCurrency;
    }
    public function getFloorPrice24hPercentageChange() {
        return $this->FloorPrice24hPercentageChange;
    }
    public function getID_TRENDING_NFT() {
        return $this->ID_TRENDING_NFT;
    }
}   