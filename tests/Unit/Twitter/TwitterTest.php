<?php

namespace Tests\Unit\Twitter;

use PHPUnit\Framework\TestCase;
use App\Twitter\Twitter;
use App\Twitter\Request\Auth;
use App\Twitter\Request\Factory;

class TwitterTest extends TestCase
{
    public function testBuildTwitter()
    {
        $twitter = new Twitter(new Auth('123', 'ABC', '456', 'DEF'), new Factory);

        $this->assertInstanceOf(Twitter::class, $twitter);
    }
}
