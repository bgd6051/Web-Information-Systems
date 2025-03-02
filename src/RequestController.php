<?php

class RequestController
{
    public function get_request_code(array $request): int
    {
        if(empty($request[0])) return WRONG_REQUEST_CODE;
        switch($request[0])
        {
            
            default: return WRONG_REQUEST_CODE;
        }
    }

    private function get_configurated_curl(bool $is_post_request, string $domain, string $path, string|NULL $params, array|NULL $body) : CurlHandle
    {
        $curl = curl_init();
        if(empty($params))
            $params = "";

        if(!empty($body))
            curl_setopt($curl,CURLOPT_POSTFIELDS, $body);

        curl_setopt($curl,CURLOPT_POST, $is_post_request);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $domain.$path."?".$params);
        curl_setopt($curl, CURLOPT_HTTPHEADER, AUTH_HEADER);
        return $curl;
    }

    public function get_response_from_domain(bool $is_post_request, string $domain, string $path, string|NULL $params, array|NULL $body): Response
    {
        $curl = $this->get_configurated_curl($is_post_request, $domain, $path, $params, $body);
        $response = curl_exec($curl);
        curl_close($curl);
        return new Response(curl_getinfo($curl, CURLINFO_HTTP_CODE), ((array)(json_decode($response)))["data"]);
    }
}