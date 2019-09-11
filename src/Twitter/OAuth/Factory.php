<?php

namespace App\Twitter\OAuth;

use App\Twitter\OAuth\OAuth;
use App\Twitter\OAuth\Auth;
use App\Twitter\OAuth\Connection;

class Factory
{
    public function make(Auth $auth): Oauth
    {
        return new OAuth(new Connection($auth));
    }
}
