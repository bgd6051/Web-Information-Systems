<?php 

class ExchangeRequest extends RequestController 
{
    public static function getExchangeResponseContent() 
    {
        $url = URL_EXCHANGE_INFO;
        return self::get_response_from_domain(url: $url);
    }
}