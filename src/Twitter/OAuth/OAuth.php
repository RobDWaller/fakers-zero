<?php

namespace App\Twitter\OAuth;

use App\Twitter\OAuth\Connection;

/**
 * OAuth Authorisation class for signing user into Twitter
 */
class OAuth
{
    private $twitterConnection;

    public function __construct(Connection $twitterConnection)
    {
        $this->twitterConnection = $twitterConnection->makeConnection();
    }

    public function getOAuthRequestToken(array $data)
    {
        return $this->twitterConnection->oauth("oauth/request_token", $data);
    }

    public function getOAuthUrl(array $data)
    {
        return $this->twitterConnection->url("oauth/authenticate", $data);
    }

    public function getAccessToken(array $data)
    {
        return $this->twitterConnection->oauth("oauth/access_token", $data);
    }
}
