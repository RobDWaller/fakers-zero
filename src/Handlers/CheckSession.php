<?php

declare(strict_types=1);

namespace App\Handlers;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\ResponseFactory;
use App\Aggregates\User;
use App\Helper\Token;

class CheckSession extends Handler implements RequestHandlerInterface
{
    private $user;

    private $token;

    public function __construct(User $user, Token $token)
    {
        $this->user = $user;

        $this->token = $token;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($this->user->checkSession()) {
            try {
                $token = $this->token->make($this->user->getSessionUserId());

                return $this->success(200, 'Ok', 'Access Token created successfully.', ['access_token' => $token]);
            } catch (\Exception $e) {
                return $this->error(
                    500,
                    'Internal Server Error.',
                    'Something went wrong with authorisation.',
                    $e->getMessage()
                );
            }
        }

        return $this->error(
            401,
            'Unathorised',
            'Please login to aquire an access token.',
            ''
        );
    }
}
