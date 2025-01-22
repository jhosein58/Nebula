<?php

namespace Nebula\ApplicationBuilder;

use Nebula\Application;
use Nebula\ApplicationBuilder\Interface\ApplicationBuilderInterface;
use Nebula\Utils\HelpersLoader;

class DefaultApplicationBuilder implements ApplicationBuilderInterface
{
    public function __construct(protected Application $app, protected HelpersLoader $helpersLoader){}
    public function withHelpers(): ApplicationBuilderInterface{
        $this->helpersLoader->load(__DIR__.'/../Utils/Helpers');
        return $this;
    }
    public function withRouting(array|string|null $router = null): ApplicationBuilderInterface
    {
        if ($router === null) return $this;
        if (is_string($router)) {
            $newRouter = $router;
            unset($router);
            $router = [$newRouter];
        }
        foreach ($router as $segment) {
            include_once $segment;
        }
        return $this;
    }
    public function preBoot(callable $callback = null): ApplicationBuilderInterface{
        call_user_func($callback);
        return $this;
    }
}