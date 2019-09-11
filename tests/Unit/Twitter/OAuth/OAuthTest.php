<?php

namespace Tests\Unit\Twitter\OAuth;

use PHPUnit\Framework\TestCase;
use App\Twitter\OAuth\Auth;
use App\Twitter\OAuth\Connection;
use App\Twitter\OAuth\OAuth;

class RequestTest extends TestCase
{
    public function testBuildOAuth()
    {
        $auth = new Auth('456', 'BNH');

        $connection = new Connection($auth);

        $this->assertInstanceOf(OAuth::class, new OAuth($connection));
    }
}
