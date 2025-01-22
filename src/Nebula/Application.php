<?php

namespace Nebula;

use Nebula\ApplicationBuilder\DefaultApplicationBuilder;
use Nebula\Core\Container;
use Nebula\Utils\HelpersLoader;

class Application extends Container
{
    /**
     * The Nebula framework version
     * @var string
     */
    const VERSION = '1.0.0';

    protected $basePath;

    private static ?Application $applicationInstance = null;
    private function __construct(){}
    public static function launch(?string $basePath = null)
    {
        return (new DefaultApplicationBuilder(static::getInstance(), new HelpersLoader()))
            ->withHelpers();
    }
    private static function getInstance(): Application{

        if(!self::$applicationInstance)
            self::$applicationInstance = new static();

        return self::$applicationInstance;
    }
}
