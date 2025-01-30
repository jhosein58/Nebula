<?php

namespace Nebula\Http;

readonly class Request
{
    public string $method;
    public string $url;
    public array $get;
    public function __construct()
    {
        $this->method = $this->method();
        $this->url = $this->url();
        $this->get = $this->get();
    }
    private function method(): string{
        return $_SERVER['REQUEST_METHOD'];
    }
    private function url(): string{
        return $_SERVER['REQUEST_URI'];
    }
    private function queryString(): string | null{
        return $_SERVER['QUERY_STRING'] ?? null;
    }
    public function get(): array{
        return $_GET;
    }
}