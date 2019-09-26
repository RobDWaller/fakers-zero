<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->get('/', function(Request $request, Response $response) {
    $response->getBody()->write($this->get('view')->render('home.html'));
    return $response;
});

$app->post('/authenticate', function(Request $request, Response $response) use ($app) {
    $handler = new App\Handlers\Auth\OAuthUrl(
        new App\Aggregates\Twitter(
            $this->get('twitter_oauth'),
            $this->get('session'),
            $this->get('uri')
        )
    );
    return $handler->handle($request);
});

$app->get('/env', function(Request $request, Response $response) {
    $response->getBody()->write(getenv("TWITTER_ACCESS_TOKEN"));
    return $response;
});
