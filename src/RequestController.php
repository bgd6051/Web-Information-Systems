<?php

class RequestController
{
    private function get_configurated_curl(string $url) : CurlHandle
    {
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, value: $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, AUTH_HEADER);
        return $curl;
    }

    public function get_response_from_domain(string $url)
    {
        $curl = $this->get_configurated_curl( $url);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}