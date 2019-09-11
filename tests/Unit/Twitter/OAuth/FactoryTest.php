<?php

namespace Tests\Unit\Twitter\OAuth;

use PHPUnit\Framework\TestCase;
use App\Twitter\OAuth\Auth;
use App\Twitter\OAuth\Factory;
use App\Twitter\OAuth\OAuth;

class FactoryTest extends TestCase
{

    public function testBuildOAuth()
    {
        $factory = new Factory;

        $auth = new Auth('9n9', 'fgr');

        $this->assertInstanceOf(OAuth::class, $factory->make($auth));
    }
}
