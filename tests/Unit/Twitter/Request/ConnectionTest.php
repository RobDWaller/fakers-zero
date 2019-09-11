<?php

namespace Tests\Unit\Twitter\Request;

use PHPUnit\Framework\TestCase;
use App\Twitter\Request\Connection;
use App\Twitter\Request\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;

class ConnectionTest extends TestCase
{
    public function testBuildConnection()
    {
        $auth = new Auth('456', 'BNH', '909', 'fgr');

        $connection = new Connection($auth);

        $this->assertInstanceOf(Connection::class, $connection);
    }

    public function testMakeConnection()
    {
        $auth = new Auth('456', 'BNH', '909', 'fgr');

        $connection = new Connection($auth);

        $this->assertInstanceOf(TwitterOauth::class, $connection->makeConnection());
    }
}
