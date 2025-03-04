<?php

class UrlManager
{
    public function get_url_path(): Array
    {
        $exploded_url_path = explode('/', strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
        for($i = 1, $iMax = count($exploded_url_path); $i < $iMax; $i++)
        {
            $exploded_url_path[$i-1] = $exploded_url_path[$i];
        }
        return $exploded_url_path;
    }

    public function get_url_params(array|null $required_params): array|null
    {
        $params = [];
        if (empty($required_params)) {
            return null;
        }

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET' || $method === 'POST') {
            foreach ($required_params as $required_param) {
                $source = ($method === 'GET') ? $_GET : $_POST;
                if (isset($source[$required_param])) {
                    is_array($source[$required_param])
                        ? $params[$required_param] = $source[$required_param]
                        : $params[$required_param] = $source[$required_param];
                }
            }
        }
        return empty($params) ? null : $params;
    }

    public function get_body_params(): array|NULL
    {
        return (array) json_decode(file_get_contents('php://input'));
    }
}