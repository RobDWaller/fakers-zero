<?php

declare(strict_types=1);

namespace App\Handlers\Auth;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Aggregates\Twitter;
use App\Aggregates\User;
use App\Helper\Uri;
use Slim\Psr7\Factory\ResponseFactory;
use Exception;

class OAuthReturn implements RequestHandlerInterface
{
    private $twitter;

    private $user;

    private $uri;

    public function __construct(Twitter $twitter, User $user, Uri $uri)
    {
        $this->twitter = $twitter;

        $this->user = $user;

        $this->uri = $uri;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $factory = new ResponseFactory();

        $url = $this->uri->build('/dashboard');
        
        try {
            $tokens = $this->twitter->getAccessTokens($request);
            
            if (!$this->user->exists($tokens['user_id'])) {
                $this->user->add($tokens);
                
                $response = $factory->createResponse(303, 'See Other');
                return $response->withAddedHeader('Location', $url);
            }
            
            $this->user->update($tokens);

            $response = $factory->createResponse(303, 'See Other');
            return $response->withAddedHeader('Location', $url);
        } catch (Exception $e) {
            $response = $factory->createResponse(401, 'Unauthorised');
            $response = $response->withAddedHeader('Content-Type', 'application/json');
            $response->getBody()->write(
                (string) json_encode(
                    [
                        'message' => 'Twitter Authorisation Failed',
                        'data' => $e->getMessage()
                    ]
                )
            );
            return $response;
        }
    }
}
