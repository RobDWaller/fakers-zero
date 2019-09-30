<?php

declare(strict_types=1);

namespace App\Handlers\Auth;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Aggregates\Twitter;
use Slim\Psr7\Factory\ResponseFactory;
use Exception;

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
            $tokens = $this->twitter->getAccessTokens($request);
            
            $response = $factory->createResponse(200, 'Ok');
            $response = $response->withAddedHeader('Content-Type', 'application/json');
            return $response->getBody()->write(json_encode($tokens));
        } catch (Exception $e) {
            $response = $factory->createResponse(401, 'Unauthorised');
            $response = $response->withAddedHeader('Content-Type', 'application/json');
            return $response->getBody()->write(json_encode(['message' => 'Twitter Authorisation Failed']));
        }
    }
}
