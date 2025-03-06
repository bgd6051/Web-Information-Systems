<?php 

class CoinChartRequest extends RequestController 
{
    public static function getCoinChartResponseContent() 
    {
        $url = URL_COIN_CHART;
        return self::get_response_from_domain(url: $url);
    }
}