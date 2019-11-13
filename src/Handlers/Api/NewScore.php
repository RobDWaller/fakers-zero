<?php

declare(strict_types=1);

namespace App\Handlers\Api;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\ResponseFactory;
use App\Aggregates\User;
use App\Helper\Token;
use App\Handlers\Handler;

class NewScore extends Handler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->success(201, 'Created', 'New Faker score created.', []);
    }
}