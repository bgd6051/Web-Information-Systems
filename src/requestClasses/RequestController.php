<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Constants.php";

class RequestController
{
    private static function getConfiguredCurl(string $url) 
    {
        $curl = curl_init();
        $url = trim($url);
        echo $url . "\n";
        curl_setopt($curl,CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL,  $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, AUTH_HEADER);
        return $curl;
    }

    public static function getResponseFromDomain(string $url) : array
    {
        $curl = self::getConfiguredCurl($url);
        $response = curl_exec($curl);

        if ($response === false) {
            die("cURL Error: " . curl_error($curl));
        }

        curl_close($curl);

        $decodedResponse = json_decode($response, true);

        if ($decodedResponse === null) {
            die("JSON Decode Error: " . json_last_error_msg() . " | Response: " . $response);
        }

        return $decodedResponse;
    }
}