<?php

namespace Tests\Unit\Twitter\Request;

use PHPUnit\Framework\TestCase;
use App\Twitter\Request\Auth;

class AuthTest extends TestCase
{
    public function testBuildAuth()
    {
        $auth = new Auth('123', 'ABC', 'DEF', '567');

        $this->assertInstanceOf(Auth::class, $auth);
    }

    public function testGetKey()
    {
        $auth = new Auth('Hello', 'World', 'Foo', 'Bar');

        $this->assertEquals($auth->getKey(), 'Hello');
    }

    public function testGetSecret()
    {
        $auth = new Auth('Hello', 'World', 'Foo', 'Bar');

        $this->assertEquals($auth->getSecret(), 'World');
    }

    public function testGetAccessToken()
    {
        $auth = new Auth('Hello', 'World', 'Foo', 'Bar');

        $this->assertEquals($auth->getAccessToken(), 'Foo');
    }

    public function testGetAccessTokenSecret()
    {
        $auth = new Auth('Hello', 'World', 'Foo', 'Bar');

        $this->assertEquals($auth->getAccessTokenSecret(), 'Bar');
    }
}
