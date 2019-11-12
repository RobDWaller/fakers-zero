<?php

namespace Tests\Unit\Fakers\Followers;

use PHPUnit\Framework\TestCase;
use Tests\Helper\FakeUser;
use App\TwitterMapper\Mapper;
use App\Fakers\Followers\Calculator;
use App\Fakers\Followers\Checks\Checker;
use App\Fakers\Followers\Checks\Checks;
use App\Fakers\Followers\Checks\Callbacks;
use Doctrine\Common\Collections\ArrayCollection;
use ReflectionMethod;
use Mockery as m;

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

    public function testCalculatePercentage()
    {
        $answers = m::mock(ArrayCollection::class);

        $calculator = new Calculator($answers);

        $method = new ReflectionMethod(Calculator::class, 'calculatePercentage');
        $method->setAccessible(true);

        $result = $method->invokeArgs($calculator, [3, 10]);

        $this->assertSame($result, 30.00);
    }

    public function testCalculatePercentageOddDivision()
    {
        $answers = m::mock(ArrayCollection::class);

        $calculator = new Calculator($answers);

        $method = new ReflectionMethod(Calculator::class, 'calculatePercentage');
        $method->setAccessible(true);

        $result = $method->invokeArgs($calculator, [5, 13]);

        $this->assertSame($result, 38.46);
    }

    public function testCalculatePercentageTotalZero()
    {
        $answers = m::mock(ArrayCollection::class);

        $calculator = new Calculator($answers);

        $method = new ReflectionMethod(Calculator::class, 'calculatePercentage');
        $method->setAccessible(true);

        $result = $method->invokeArgs($calculator, [5, 0]);

        $this->assertSame($result, 0.0);
    }

    public function tearDown(): void
    {
        m::close();
    }
}
