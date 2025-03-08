<?php 

class CoinChartRequest extends RequestController 
{
    public static function getCoinChartResponseContent(int $ID_COIN) 
    {
        $url = URL_COIN_CHART_FIRST_PART . $ID_COIN . URL_COIN_CHART_SECOND_PART;
        return self::get_response_from_domain(url: $url);
    }
}