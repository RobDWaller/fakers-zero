<?php

namespace App\Twitter\Request;

use App\Twitter\Request\Auth;
use App\Twitter\Request\Connection;
use App\Twitter\Request\Request;

class Factory
{
    public function make(Auth $auth): Request
    {
        return new Request(new Connection($auth));
    }
}
