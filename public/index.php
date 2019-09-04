<?php

use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();

AppFactory::setContainer($container);
$app = AppFactory::create();

require __DIR__ . '/../src/services.php';
require __DIR__ . '/../src/routes.php';

$app->run();
