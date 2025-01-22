<?php

namespace Nebula\Utils;

class HelpersLoader
{
    public static function load(string $directory): void
    {
        $files = glob($directory . '/*.php');
        foreach ($files as $file) {
            include_once $file;
        }
    }
}