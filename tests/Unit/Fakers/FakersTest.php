<?php

namespace Tests\Unit\Fakers;

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

        $users = $mapper->buildUsers($fakeUser->getUsers(5, true));

        $faker = new Fakers($users);

        $this->assertInstanceOf(Score::class, $faker->getFakerScore());
    }
}
