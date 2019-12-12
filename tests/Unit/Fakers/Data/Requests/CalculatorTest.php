<?php

namespace Tests\Unit\Fakers\Data\Requests;

use PHPUnit\Framework\TestCase;
use App\Fakers\Data\Requests\Calculator;

class CalculatorTest extends TestCase
{
    public function testRequestsCalculator()
    {
        $calculator = new Calculator(5000, 5);

        $this->assertInstanceOf(Calculator::class, $calculator);
    }

    public function testCalculate()
    {
        $calculator = new Calculator(5000, 5);

        $this->assertSame($calculator->calculate(10000), 2);
    }

    public function testCalculateMaxRequests()
    {
        $calculator = new Calculator(5000, 5);

        $this->assertSame($calculator->calculate(100000), 5);
    }

    public function testCalculateOddFollowers()
    {
        $calculator = new Calculator(5000, 5);

        $this->assertSame($calculator->calculate(7500), 1);
    }

    public function testCalculateLowFollowers()
    {
        $calculator = new Calculator(5000, 5);

        $this->assertSame($calculator->calculate(2330), 1);
    }

    public function testCalculateZeroFollowers()
    {
        $calculator = new Calculator(5000, 5);

        $this->assertSame($calculator->calculate(0), 0);
    }

    public function testDivisionZero()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Cannot divide by zero, provide a division greater than zero.');
        $calculator = new Calculator(0, 5);
    }
}