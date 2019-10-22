<?php

namespace Tests\Unit\Fakers\Followers;

use PHPUnit\Framework\TestCase;
use Tests\Helper\FakeUser;
use App\TwitterMapper\Mapper;
use App\Fakers\Followers\Calculator;
use App\Fakers\Followers\Answers\Builder;
use App\Fakers\Followers\Checks\Fake;
use App\Fakers\Followers\Checks\Inactive;
use App\Fakers\Followers\Checks\Good;

class CalculatorTest extends TestCase
{
    public function testBuildScore()
    {
        $mapper = new Mapper();

        $fakeUser = new FakeUser();

        $user = $mapper->buildUser($fakeUser->getUser());

        $answerBuilder = new Builder(new Fake(), new Inactive(), new Good());

        $answers = $answerBuilder->run($user);

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

        $answerBuilder = new Builder(new Fake(), new Inactive(), new Good());

        $answers = $answerBuilder->run($user);

        $score = new Calculator($answers);

        $this->assertLessThanOrEqual(100, $score->getFakePercentage());
        $this->assertLessThanOrEqual(100, $score->getInactivePercentage());
        $this->assertLessThanOrEqual(100, $score->getGoodPercentage());
    }
}
