<?php

require_once "vendor/autoload.php";


$app = \Nebula\Application::launch();

$app->route->get('/', function () {
    echo "Hello World!";
});

$app->route->get('/user/id:{id}-pass:{pass}', function ($id, $pass) {
    echo "Hello " . $id . ", " . $pass;
});

$app->start();