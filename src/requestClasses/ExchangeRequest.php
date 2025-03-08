<?php 

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Constants.php";

class ExchangeRequest extends RequestController 
{
    public static function getExchangeResponseContent() 
    {
        $url = URL_EXCHANGE_INFO;
        return self::getResponseFromDomain( $url);
    }
}