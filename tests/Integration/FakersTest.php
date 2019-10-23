<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use App\Fakers\Fakers;
use App\Fakers\Score;
use Tests\Helper\FakeUser;
use App\TwitterMapper\Mapper;

class FakersTest extends TestCase
{
    public function testGetFakerScore()
    {
        $fakeUser = new FakeUser();

        $mapper = new Mapper();

        $users = $mapper->buildUsers($fakeUser->getUsers(100, true));

        $faker = new Fakers($users);

        $this->assertInstanceOf(Score::class, $faker->getFakerScore());
    }

    public function testBigGetFakerScore()
    {
        $fakeUser = new FakeUser();

        $mapper = new Mapper();

        $users = $mapper->buildUsers($fakeUser->getUsers(2000, true));

        $faker = new Fakers($users);

        $this->assertInstanceOf(Score::class, $faker->getFakerScore());
    }
}
