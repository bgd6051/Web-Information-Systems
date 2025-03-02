<?php

class Response
{
    private int $HTTP_code;
    private array|null $body;
    public function __construct(int $HTTP_code, array|null $body)
    {
        $this->HTTP_code = $HTTP_code;
        $this->body = $body;
    }

    public function getHTTP_code(): int|NULL
    {
        return $this->HTTP_code;
    }

    public function get_body(): array|NULL
    {
        return $this->body;
    }

    public function get_body_as_string(): string|NULL
    {
        return json_encode($this->body);
    }
}
