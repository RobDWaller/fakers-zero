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
}