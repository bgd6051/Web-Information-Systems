<?php
class TrendingNft
{
    private $Id;
    private $Name;
    private $Symbol;
    private $Thumb;
    private $NativeCurrencySymbol;
    private $FloorPriceInNativeCurrency;
    private $FloorPrice24hPercentageChange;
    private $ID_TRENDING_NFT;

    public function __construct( string $Id, string $Name, ?string $Symbol = null,
                                ?string $Thumb = null, ?string $NativeCurrencySymbol = null, 
                                ?float $FloorPriceInNativeCurrency = null, 
                                ?float $FloorPrice24hPercentageChange = null, 
                                ?int $ID_TRENDING_NFT = null )  
    {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->Symbol = $Symbol;
        $this->Thumb = $Thumb;
        $this->NativeCurrencySymbol = $NativeCurrencySymbol;
        $this->FloorPriceInNativeCurrency = $FloorPriceInNativeCurrency;
        $this->FloorPrice24hPercentageChange = $FloorPrice24hPercentageChange;
        $this->ID_TRENDING_NFT = $ID_TRENDING_NFT;
    }

    public static function constructTrendingNftArray(array $responseArray): array
    {
        $nftArray = $responseArray["nfts"];
        $numOfTrendingNfts = count($nftArray);
        $trendingNftList = [];
        for($i = 0; $i < $numOfTrendingNfts; $i++){
            $trendingNftLine = $nftArray[$i];
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

    public function titleHTML(): string {
        $separador = ", ";
        return "<li class='listingHeader'>Id".$separador."Name".$separador.
            "Symbol".$separador."Thumbnail".$separador."NativeCurrencySymbol".$separador.
            "FloorPriceInNativeCurrency".$separador."FloorPrice24hPercentageChange</li>";
    }

    public function toHTML(): string {
        $separador = ", ";
        $height = "50px";
        $width = "50px";
        $img = '<img src="'.$this->Thumb.'" height="'.$height.'" width="'.$width.'"/>';
        return "<li>".$this->Id.$separador.$this->Name.$separador.
            $this->Symbol.$separador.$img.$separador.$this->NativeCurrencySymbol.$separador.
            $this->FloorPriceInNativeCurrency.$separador.$this->FloorPrice24hPercentageChange."</li>";
    }
}   