<?php

namespace App\Twitter\OAuth;

use App\Twitter\OAuth\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Class for return a Twitter connection object for use in Twitter requests.
 */
class Connection
{
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function makeConnection(): TwitterOauth
    {
        if ($this->auth->hasTokens()) {
            return new TwitterOAuth(
                $this->auth->getKey(),
                $this->auth->getSecret(),
                $this->auth->getOAuthToken(),
                $this->auth->getOAuthTokenSecret()
            );
        }

        return new TwitterOAuth(
            $this->auth->getKey(),
            $this->auth->getSecret()
        );
    }
}
