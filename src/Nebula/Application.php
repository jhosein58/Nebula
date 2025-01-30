<?php

namespace Nebula;

use Nebula\ApplicationBuilder\DefaultApplicationBuilder;
use Nebula\Core\Container;
use Nebula\Http\Request;
use Nebula\Http\Route;
use Nebula\Utils\HelpersLoader;

class Application extends Container
{
    const VERSION = '1.0.0';
    protected $basePath;
    public Route $route;
    public Request $request;

    private static ?Application $applicationInstance = null;
    private function __construct(){}
//    public static function launch(?string $basePath = null)
//    {
//        return (new DefaultApplicationBuilder(static::getInstance(), new HelpersLoader()))
//            ->withHelpers();
//    }
    protected static function getInstance(): Application{
        return static::$applicationInstance ?? (static::$applicationInstance = new static);
    }
    public static function launch()
    {
        $app = static::getInstance();
        $app->route = new Route;
        $app->request = new Request;
        return $app;
    }
    public function start()
    {
        $this->route->run($this->request);
    }
}
