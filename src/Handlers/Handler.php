<?php

declare(strict_types=1);

namespace App\Handlers;

use Slim\Psr7\Factory\ResponseFactory;
use Psr\Http\Message\ResponseInterface as Response;

abstract class Handler
{
    protected function error(int $code, string $reason, string $message, string $error): Response
    {
        $factory = new ResponseFactory();
        
        $response = $factory->createResponse($code, $reason);
        $response = $response->withAddedHeader('Content-Type', 'application/json');
        $response->getBody()->write(
            (string) json_encode(
                [
                    'message' => $message,
                    'error' => $error
                ]
            )
        );
        return $response;
    }
}
