<?php

declare(strict_types=1);

namespace App\Helper;

use App\Helper\Environment;
use App\Helper\Uri;
use ReallySimpleJWT\Build;
use ReallySimpleJWT\Validate;
use ReallySimpleJWT\Encode;

class Token
{
    private $environment;

    private $uri;

    private $userId;

    public function __construct(Environment $environment, Uri $uri, string $userId)
    {
        $this->environment = $environment;

        $this->uri = $uri;

        $this->userId = $userId;
    }

    public function make(): string
    {
        $build = new Build('JWT', new Validate(), new Encode());

        return $build->setContentType('JWT')
            ->setSecret($this->environment->getTokenSecret())
            ->setIssuer($this->environment->getHost())
            ->setAudience($this->uri->build(''))
            ->setExpiration(time() + $this->environment->getTokenExpiry())
            ->setIssuedAt(time())
            ->setPayloadClaim('user_id', $this->userId)
            ->build()
            ->getToken();
    }
}