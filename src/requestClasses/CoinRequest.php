<?php 

class CoinRequest extends RequestController 
{
    public static function getCoinResponseContent() 
    {
        $urlFirstCall = URL_COINS_INFO_FIRST_CALL;
        $urlSecondCall = URL_COINS_INFO_SECOND_CALL;
        $firstCall = self::get_response_from_domain(url: $urlFirstCall);
        $secondCall = self::get_response_from_domain(url: $urlSecondCall);
        return array_merge($firstCall, $secondCall);
    }
}