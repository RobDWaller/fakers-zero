<?php

namespace Tests\Unit\Twitter\OAuth;

use PHPUnit\Framework\TestCase;
use App\Twitter\OAuth\Auth;

class AuthTest extends TestCase
{
    public function testBuildAuth()
    {
        $auth = new Auth('123', 'ABC');

        $this->assertInstanceOf(Auth::class, $auth);
    }

    public function testGetKey()
    {
        $auth = new Auth('Car', 'Park');

        $this->assertEquals($auth->getKey(), 'Car');
    }

    public function testGetSecret()
    {
        $auth = new Auth('Car', 'Park');

        $this->assertEquals($auth->getSecret(), 'Park');
    }

    public function testSetOauthToken()
    {
        $auth = new Auth('Car', 'Park');

        $auth->setOAuthToken('Pork');

        $this->assertEquals($auth->getOAuthToken(), 'Pork');
    }

    public function testSetOauthTokenSecret()
    {
        $auth = new Auth('Car', 'Park');

        $auth->setOAuthTokenSecret('Pie');

        $this->assertEquals($auth->getOAuthTokenSecret(), 'Pie');
    }

    public function testHasTokensTrue()
    {
        $auth = new Auth('Car', 'Park');

        $auth->setOAuthToken('Pork');
        $auth->setOAuthTokenSecret('Pie');

        $this->assertTrue($auth->hasTokens());
    }

    public function testHasTokensFalse()
    {
        $auth = new Auth('Car', 'Park');

        $auth->setOAuthToken('Pork');

        $this->assertFalse($auth->hasTokens());
    }

    public function testHasTokensFalseTwo()
    {
        $auth = new Auth('Car', 'Park');

        $auth->setOAuthTokenSecret('Pie');

        $this->assertFalse($auth->hasTokens());
    }
}
