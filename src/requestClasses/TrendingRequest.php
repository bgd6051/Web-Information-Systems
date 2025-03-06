<?php 

class TrendingRequest extends RequestController 
{
    public static function getTrendingResponseContent()
    {
        $url = URL_TRENDING_INFO;
        return self::get_response_from_domain(url: $url);
    }
}