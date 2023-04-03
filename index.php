<?php

require_once __DIR__ . '/vendor/autoload.php';

use HttpClasses\Router;

$routerInstance = Router::init(__DIR__ . '/routes');
$routerInstance->run();
