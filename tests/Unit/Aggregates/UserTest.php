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
            ->once()
            ->shouldReceive('set')
            ->with('user_id', '4323534')
            ->once();

        $user = new User($documentManager, $session);

        $result = $user->login('4323534');

        $this->assertEmpty($result);
    }

    public function testLogout()
    {
        $documentManager = m::mock(DocumentManager::class);
        $session = m::mock(Session::class);
        $session->shouldReceive('delete')
            ->with('login')
            ->once()
            ->shouldReceive('delete')
            ->with('user_id')
            ->once();

        $user = new User($documentManager, $session);

        $result = $user->logout();

        $this->assertEmpty($result);
    }

    public function testCheckSession()
    {
        $documentManager = m::mock(DocumentManager::class);
        $session = m::mock(Session::class);
        $session->shouldReceive('get')
            ->with('login')
            ->once()
            ->andReturn(1);

        $user = new User($documentManager, $session);

        $this->assertTrue($user->checkSession());
    }

    public function testCheckSessionFalse()
    {
        $documentManager = m::mock(DocumentManager::class);
        $session = m::mock(Session::class);
        $session->shouldReceive('get')
            ->with('login')
            ->once()
            ->andReturn(0);

        $user = new User($documentManager, $session);

        $this->assertFalse($user->checkSession());
    }

    public function testGetSessionUserId()
    {
        $documentManager = m::mock(DocumentManager::class);
        $session = m::mock(Session::class);
        $session->shouldReceive('get')
            ->with('user_id')
            ->once()
            ->andReturn('4378231');

        $user = new User($documentManager, $session);

        $this->assertSame($user->getSessionUserId(), '4378231');
    }

    public function tearDown(): void
    {
        m::close();
    }
}
