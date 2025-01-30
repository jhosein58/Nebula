<?php

namespace Nebula\Http;

class Route
{
    private static $routes = [];

    private static function addRoute(string $method, string $uri, string|array|callable|null $action): void
    {
        self::$routes[$method][$uri] = $action;
    }

    public static function get($url, $action): void
    {
        self::addRoute("GET", $url, $action);
    }

    public static function post($url, $action): void
    {
        self::addRoute("POST", $url, $action);
    }

    private static function parse($url, $currentUrl): null|array{
        $pattern = "/\{.*?\}/";
        $needle = '#^' . preg_replace($pattern, '(.+?)', $url) . '$#';
        $matches = [];
        preg_match_all($needle, $currentUrl, $matches);
        if(empty($matches[0])){
            return null;
        }else{
            unset($matches[0]);
            $params = [];
            foreach($matches as $match){
                $params[] = $match[0];
            }
            return $params;
        }
    }
    private static function dispatch(Request $request): null|array
    {
        $route = self::$routes[$request->method][$request->url] ?? null;
        if ($route) return [$route, []];

        foreach (self::$routes[$request->method] as $url => $action) {
            if(!is_null(self::parse($url, $request->url))){
                return [$action, self::parse($url, $request->url)];
            }
        }
        return null;
    }
    public static function run(Request $request): void{
        [$callback, $params] = self::dispatch($request) ?? [false, null];
        if ($callback) {
            $callback(...$params);
        }
    }
}