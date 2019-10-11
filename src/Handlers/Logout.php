<?php

declare(strict_types=1);

namespace App\Handlers;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\ResponseFactory;
use App\Aggregates\User;
use App\Helper\Uri;

class Logout implements RequestHandlerInterface
{
    private $user;

    private $uri;

    public function __construct(User $user, Uri $uri)
    {
        $this->user = $user;

        $this->uri = $uri;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->user->logout();

        $factory = new ResponseFactory();
        $response = $factory->createResponse(303, 'See Other');
        return $response->withAddedHeader('Location', $this->uri->build('/'));
    }
}