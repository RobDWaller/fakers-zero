<?php

declare(strict_types=1);

namespace App\Handlers\Auth;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Handlers\Handler;
use App\Aggregates\Twitter;
use App\Aggregates\User;
use App\Helper\Uri;
use Slim\Psr7\Factory\ResponseFactory;
use Exception;

class OAuthReturn extends Handler implements RequestHandlerInterface
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

            $this->twitter->clearSession();
            $this->user->login();
            $response = $factory->createResponse(303, 'See Other');
            return $response->withAddedHeader('Location', $url);
        } catch (Exception $e) {
            return $this->error(401, 'Unauthorised', 'Twitter authorisation failed', $e->getMessage());
        }
    }
}
