<?php 

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Constants.php";

class CoinChartRequest extends RequestController 
{
    public static function getCoinChartResponseContent(int $ID_COIN) 
    {
        $url = URL_COIN_CHART_FIRST_PART . urlencode($ID_COIN) . URL_COIN_CHART_SECOND_PART;
        
        return self::getResponseFromDomain( $url);
    }
}