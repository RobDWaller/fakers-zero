<?php

namespace Tests\Unit\Aggregates;

use PHPUnit\Framework\TestCase;
use App\Aggregates\User;
use SlimSession\Helper as Session;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\ODM\MongoDB\DocumentManager;
use Mockery as m;

class UserTest extends TestCase
{
    public function testUser()
    {
        $documentManager = m::mock(DocumentManager::class);
        $session = m::mock(Session::class);

        $user = new User($documentManager, $session);

        $this->assertInstanceOf(User::class, $user);
    }

    public function testLogin()
    {
        $documentManager = m::mock(DocumentManager::class);
        $session = m::mock(Session::class);
        $session->shouldReceive('set')
            ->with('login', 1)
            ->once();

        $user = new User($documentManager, $session);

        $result = $user->login();

        $this->assertEmpty($result);
    }

    public function testLogout()
    {
        $documentManager = m::mock(DocumentManager::class);
        $session = m::mock(Session::class);
        $session->shouldReceive('delete')
            ->with('login')
            ->once();

        $user = new User($documentManager, $session);

        $result = $user->logout();

        $this->assertEmpty($result);
    }

    public function tearDown(): void
    {
        m::close();
    }
}