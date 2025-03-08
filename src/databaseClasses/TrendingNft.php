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

    public function __construct( string $Id, string $Name, string $Symbol,
                                string $Thumb, string $NativeCurrencySymbol, 
                                float $FloorPriceInNativeCurrency, float $FloorPrice24hPercentageChange, 
                                ?int $ID_TRENDING_NFT = null )  
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

    public static function constructList(array $responseArray){
        $nftArray = $responseArray["nfts"];
        $numOfTrendingNfts = count($nftArray);
        $trendingNftList = [];
        for($i = 0; $i < $numOfTrendingNfts; $i++){
            $trendingNftLine = $responseArray[$i];
            $trendingNft = new TrendingNft( $trendingNftLine["id"], $trendingNftLine["name"],
                                        $trendingNftLine["symbol"],$trendingNftLine["thumb"],
                                        $trendingNftLine["native_currency_symbol"],$trendingNftLine["floor_price_in_native_currency"],
                                        $trendingNftLine["floor_price_24h_percentage_change"] );
            $trendingNftList[$i] = $trendingNft;
        }
        return $trendingNftList;
    }
    public function getId(): string {
        return $this->Id; 
    }
    public function getName(): string {
        return $this->Name;
    }
    public function getSymbol(): string {
        return $this->Symbol;
    }
    public function getThumb(): string {
        return $this->Thumb;
    }
    public function getNativeCurrencySymbol(): string {
        return $this->NativeCurrencySymbol;
    }
    public function getFloorPriceInNativeCurrency(): float {
        return $this->FloorPriceInNativeCurrency;
    }
    public function getFloorPrice24hPercentageChange(): float {
        return $this->FloorPrice24hPercentageChange;
    }
    public function getID_TRENDING_NFT(): int {
        return $this->ID_TRENDING_NFT;
    }
}   