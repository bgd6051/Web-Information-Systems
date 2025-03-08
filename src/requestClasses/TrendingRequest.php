<?php 

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Constants.php";

class TrendingRequest extends RequestController 
{
    public static function getTrendingResponseContent()
    {
        $url = URL_TRENDING_INFO;
        return self::getResponseFromDomain( $url);
    }
}