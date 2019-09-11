<?php

namespace App\Twitter\OAuth;

/**
 * Auth object used for authorizing via OAuth with Twitter
 */
class Auth
{
    private $key;

    private $secret;

    private $oauthToken;

    private $oauthTokenSecret;

    private $hasTokens;

    public function __construct(string $key, string $secret)
    {
        $this->key = $key;

        $this->secret = $secret;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function setOAuthToken(string $oauthToken): void
    {
        $this->oauthToken = $oauthToken;
    }

    public function setOAuthTokenSecret(string $oauthTokenSecret): void
    {
        $this->oauthTokenSecret = $oauthTokenSecret;
    }

    public function getOAuthToken(): string
    {
        return $this->oauthToken;
    }

    public function getOAuthTokenSecret(): string
    {
        return $this->oauthTokenSecret;
    }

    public function hasTokens(): bool
    {
        return !empty($this->oauthToken) && !empty($this->oauthTokenSecret);
    }
}
