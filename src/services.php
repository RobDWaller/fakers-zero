<?php

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$container->set('view', function () {
    $twigLoader = new FilesystemLoader(__DIR__ . '/Views');
    return new Environment($twigLoader, ['cache' => __DIR__ . '/cache']);
});

$container->set('session', function () {
    return new SlimSession\Helper();
});

$container->set('uri', function () {
    return new App\Helper\Uri;
});
