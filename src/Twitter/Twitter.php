<?php

namespace App\Twitter;

use App\Twitter\Request\Auth;
use App\Twitter\Request\Factory;

class Twitter
{
    private $request;

    public function __construct(Auth $auth, Factory $factory)
    {
        $this->request = $factory->make($auth);
    }

    public function getFollowers(array $data): array
    {
        return $request->getData('', $data);
    }

    public function getProfile()
    {
    }

    public function postTweet()
    {
    }
}
