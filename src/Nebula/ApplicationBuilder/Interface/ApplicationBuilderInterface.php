<?php

namespace Nebula\ApplicationBuilder\Interface;

use Nebula\Application;
use Nebula\Utils\HelpersLoader;
interface ApplicationBuilderInterface
{
    public function __construct(Application $app, HelpersLoader $helpersLoader);
    public function withRouting(array | string | null $router = null, );
}