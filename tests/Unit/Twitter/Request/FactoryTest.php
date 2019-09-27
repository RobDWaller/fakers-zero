<?php

namespace Tests\Unit\Twitter\Request;

use PHPUnit\Framework\TestCase;
use App\Twitter\Request\Auth;
use App\Twitter\Request\Factory;
use App\Twitter\Request\Request;

class FactoryTest extends TestCase
{

    public function testBuildRequest()
    {
        $factory = new Factory();

        $auth = new Auth('45', 'B9H', '9n9', 'fgr');

        $this->assertInstanceOf(Request::class, $factory->make($auth));
    }
}
