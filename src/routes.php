<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write($this->get('view')->render('home.html'));
    return $response;
});

$app->get('/dashboard', function (Request $request, Response $response) {
    $response->getBody()->write($this->get('view')->render('dashboard.html'));
    return $response;
});

$app->post('/authenticate', function (Request $request, Response $response) {
    $handler = new App\Handlers\Auth\OAuthUrl(
        new App\Aggregates\Twitter(
            new App\Twitter\TwitterOAuth(
                new App\Twitter\OAuth\Auth(getenv('TWITTER_KEY'), getenv('TWITTER_SECRET')),
                new App\Twitter\OAuth\Factory()
            ),
            $this->get('session'),
            $this->get('uri')
        )
    );
    return $handler->handle($request);
});

$app->get('/authenticate/return', function (Request $request, Response $response) use ($app) {
    
    $auth = new App\Twitter\OAuth\Auth(getenv('TWITTER_KEY'), getenv('TWITTER_SECRET'));
    $auth->setOAuthToken($this->get('session')->oauth_token);
    $auth->setOAuthTokenSecret($this->get('session')->oauth_token_secret);
    
    $handler = new App\Handlers\Auth\OAuthReturn(
        new App\Aggregates\Twitter(
            new App\Twitter\TwitterOAuth(
                $auth,
                new App\Twitter\OAuth\Factory()
            ),
            $this->get('session'),
            $this->get('uri')
        ),
        new App\Aggregates\User(
            $this->get('document_manager'),
            $this->get('session')
        ),
        $this->get('uri')
    );
    return $handler->handle($request);
});
