<?php

namespace Tests\Unit\Helper;

use PHPUnit\Framework\TestCase;
use App\Model\User;

class UserTest extends TestCase
{
    public function testUser()
    {
        $user = new User();

        $this->assertInstanceOf(User::class, $user);
    }

    public function testUserId()
    {
        $user = new User();

        $user->setUserId("123456");

        $this->assertSame("123456", $user->getUserId());
    }

    public function testUserIdBigInt()
    {
        $user = new User();

        $user->setUserId("80938271829374859489");

        $this->assertSame("80938271829374859489", $user->getUserId());
    }

    public function testScreenName()
    {
        $user = new User();

        $user->setScreenName('RobDWaller');

        $this->assertSame($user->getScreenName(), 'RobDWaller');
    }

    public function testOAuthToken()
    {
        $user = new User();

        $user->setOAuthToken('haskj12jrjd');

        $this->assertSame($user->getOAuthToken(), 'haskj12jrjd');
    }

    public function testOAuthTokenSecret()
    {
        $user = new User();

        $user->setOAuthTokenSecret('8349ir-iasdie-239');

        $this->assertSame($user->getOAuthTokenSecret(), '8349ir-iasdie-239');
    }
}