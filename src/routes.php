<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->get('/', function(Request $request, Response $response) {
    $response->getBody()->write($this->get('view')->render('home.html'));
    return $response;
});

$app->get('/authenticate', function(Request $request, Response $response) {
    $response->getBody()->write('Authenticate!');
    return $response;
});

$app->get('/env', function(Request $request, Response $response) {
    $response->getBody()->write(getenv("FOO"));
    return $response;
});
