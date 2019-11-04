<?php

namespace Tests\Unit\Fakers\Followers;

use PHPUnit\Framework\TestCase;
use Tests\Helper\FakeUser;
use App\TwitterMapper\Mapper;
use App\Fakers\Followers\Calculator;
use App\Fakers\Followers\Checks\Checker;
use App\Fakers\Followers\Checks\Checks;
use App\Fakers\Followers\Checks\Callbacks;

class CalculatorTest extends TestCase
{
    public function testBuildScore()
    {
        $mapper = new Mapper();

        $fakeUser = new FakeUser();

        $user = $mapper->buildUser($fakeUser->getUser());

        $checker = new Checker(new Checks(), new Callbacks());

        $answers = $checker->check($user);

        $score = new Calculator($answers);

        $this->assertTrue(is_float($score->getFakePercentage()));
        $this->assertTrue(is_float($score->getInactivePercentage()));
        $this->assertTrue(is_float($score->getGoodPercentage()));
    }

    public function testCheckScore()
    {
        $mapper = new Mapper();

        $fakeUser = new FakeUser();

        $user = $mapper->buildUser($fakeUser->getUser());

        $checker = new Checker(new Checks(), new Callbacks());

        $answers = $checker->check($user);

        $score = new Calculator($answers);

        $this->assertLessThanOrEqual(100, $score->getFakePercentage());
        $this->assertLessThanOrEqual(100, $score->getInactivePercentage());
        $this->assertLessThanOrEqual(100, $score->getGoodPercentage());
    }
}
