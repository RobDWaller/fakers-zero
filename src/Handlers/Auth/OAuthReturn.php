<?php

declare(strict_types=1);

namespace App\Handlers\Auth;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Aggregates\Twitter;
use Slim\Psr7\Factory\ResponseFactory;

class OAuthReturn implements RequestHandlerInterface
{
    private $twitter;

    public function __construct(Twitter $twitter)
    {
        $this->twitter = $twitter;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $factory = new ResponseFactory();
        
        try {
            var_dump($this->twitter->getAccessTokens($request));
            die();
        } catch (Exception $e) {
            die();
        }
    }
}
