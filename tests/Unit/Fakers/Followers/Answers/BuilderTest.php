<?php

namespace Tests\Unit\Fakers\Followers\Answers;

use PHPUnit\Framework\TestCase;
use Tests\Helper\FakeUser;
use App\Fakers\Followers\Answers\Builder;
use App\Fakers\Followers\Checks\Fake;
use App\Fakers\Followers\Checks\Inactive;
use App\Fakers\Followers\Checks\Good;
use App\TwitterMapper\Mapper;
use Doctrine\Common\Collections\ArrayCollection;

class BuilderTest extends TestCase
{
    public function testRunCheck()
    {
        $check = new Builder(new Fake(), new Inactive(), new Good());

        $user = new FakeUser();

        $mapper = new Mapper();

        $result = $check->run($mapper->buildUser($user->getUser()));

        $this->assertInstanceOf(ArrayCollection::class, $result);

        $this->assertEquals(23, $result->count());
    }

    public function testCheckFake()
    {
        $check = new Builder(new Fake(), new Inactive(), new Good());

        $user = new FakeUser();

        $mapper = new Mapper();

        $result = $check->run($mapper->buildUser($user->getUser()));

        $this->assertEquals(23, $result->count());

        $fakes = $result->filter(function ($fake) {
            return $fake->getType() === 'fake';
        });

        $this->assertEquals(10, $fakes->count());
    }

    public function testCheckInactive()
    {
        $check = new Builder(new Fake(), new Inactive(), new Good());

        $user = new FakeUser();

        $mapper = new Mapper();

        $result = $check->run($mapper->buildUser($user->getUser()));

        $inactives = $result->filter(function ($inactive) {
            return $inactive->getType() === 'inactive';
        });

        $this->assertEquals(6, $inactives->count());
    }

    public function testCheckGood()
    {
        $check = new Builder(new Fake(), new Inactive(), new Good());

        $user = new FakeUser();

        $mapper = new Mapper();

        $result = $check->run($mapper->buildUser($user->getUser()));

        $goods = $result->filter(function ($good) {
            return $good->getType() === 'good';
        });

        $this->assertEquals(7, $goods->count());
    }

    public function testRunMultipleChecks()
    {
        $check = new Builder(new Fake(), new Inactive(), new Good());

        $user = new FakeUser();

        $mapper = new Mapper();

        $users = $mapper->buildUsers($user->getUsers(10));

        foreach ($users as $user) {
            $result = $check->run($user);

            $this->assertInstanceOf(ArrayCollection::class, $result);

            $this->assertEquals(23, $result->count());
        }
    }
}
