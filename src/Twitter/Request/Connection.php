<?php

namespace App\Twitter\Request;

use App\Twitter\Request\Auth;
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

    public function makeConnection(): TwitterOAuth
    {
        return new TwitterOAuth(
            $this->auth->getKey(),
            $this->auth->getSecret(),
            $this->auth->getAccessToken(),
            $this->auth->getAccessTokenSecret()
        );
    }
}
