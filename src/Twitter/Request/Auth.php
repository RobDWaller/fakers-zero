<?php

namespace App\Twitter\Request;

/**
 * Auth object used for creating connections to Twitter
 */
class Auth
{
    private $key;

    private $secret;

    private $accessToken;

    private $accessTokenSecret;

    public function __construct(string $key, string $secret, string $accessToken, string $accessTokenSecret)
    {
        $this->key = $key;

        $this->secret = $secret;

        $this->accessToken = $accessToken;

        $this->accessTokenSecret = $accessTokenSecret;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getAccessTokenSecret()
    {
        return $this->accessTokenSecret;
    }
}
