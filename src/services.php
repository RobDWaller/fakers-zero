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

$container->set('twitter_oauth', function () {
    return new App\Twitter\TwitterOAuth(
        new App\Twitter\OAuth\Auth(getenv('TWITTER_KEY'), getenv('TWITTER_SECRET')),
        new App\Twitter\OAuth\Factory()
    );
});
