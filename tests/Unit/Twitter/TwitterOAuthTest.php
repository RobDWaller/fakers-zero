<?php

namespace Tests\Unit\Twitter;

use PHPUnit\Framework\TestCase;
use App\Twitter\TwitterOAuth;
use App\Twitter\OAuth\Auth;
use App\Twitter\OAuth\Factory;

class TwitterOAuthTest extends TestCase
{
    public function testBuildTwitterOAuth()
    {
        $twitterOAuth = new TwitterOAuth(new Auth('123', 'ABC'), new Factory());

        $this->assertInstanceOf(TwitterOAuth::class, $twitterOAuth);
    }
}
