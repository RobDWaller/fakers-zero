<?php

declare(strict_types=1);

namespace App\Handlers\Auth;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Aggregates\Twitter;
use Slim\Psr7\Factory\ResponseFactory;

class OAuthUrl implements RequestHandlerInterface
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
            $url = $this->twitter->buildOAuthUrl($request);
            
            $response = $factory->createResponse(303, 'See Other');
            return $response->withAddedHeader('Location', $url);
        } catch (Exception $e) {
            die();
        }
    }
}