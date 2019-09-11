<?php

namespace App\Twitter;

use App\Twitter\OAuth\Factory;
use App\Twitter\OAuth\Auth;

class TwitterOAuth
{
    private $request;

    public function __construct(Auth $auth, Factory $factory)
    {
        $this->request = $factory->make($auth);
    }

    public function getOAuthRequestToken(array $data)
    {
        return $this->request->getOAuthRequestToken($data);
    }

    public function getOAuthUrl(array $data)
    {
        return $this->request->getOAuthUrl($data);
    }

    public function getAccessToken(array $data)
    {
        return $this->request->getAccessToken($data);
    }
}
