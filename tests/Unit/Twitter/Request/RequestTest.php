<?php

namespace Tests\Unit\Twitter\Request;

use PHPUnit\Framework\TestCase;
use App\Twitter\Request\Auth;
use App\Twitter\Request\Connection;
use App\Twitter\Request\Request;

class RequestTest extends TestCase
{
    public function testBuildRequest()
    {
        $auth = new Auth('456', 'BNH', '909', 'fgr');

        $connection = new Connection($auth);

        $this->assertInstanceOf(Request::class, new Request($connection));
    }
}
