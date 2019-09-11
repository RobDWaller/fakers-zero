<?php

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$container->set('view', function () {
    $twigLoader = new FilesystemLoader(__DIR__ . '/Views');
    return new Environment($twigLoader, ['cache' => __DIR__ . '/cache']);
});
