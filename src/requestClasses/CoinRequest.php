<?php 

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Constants.php";

class CoinRequest extends RequestController 
{
    public static function getCoinResponseContent() : array 
    {
        $urlFirstCall = URL_COINS_MARKETS .  urlencode(COINS_ID_FIRST_CALL);
        $urlSecondCall = URL_COINS_MARKETS .  urlencode(COINS_ID_SECOND_CALL);

        $firstCall = self::getResponseFromDomain($urlFirstCall);
        $secondCall = self::getResponseFromDomain($urlSecondCall);

        return array_merge($firstCall, $secondCall);
    }
}