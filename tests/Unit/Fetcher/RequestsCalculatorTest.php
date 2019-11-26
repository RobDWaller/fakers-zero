<?php

namespace Tests\Unit\Fetcher;

use PHPUnit\Framework\TestCase;
use App\Fetcher\RequestsCalculator;

class RequestsCalculatorTest extends TestCase
{
    public function testRequestsCalculator()
    {
        $calculator = new RequestsCalculator(5000, 5);

        $this->assertInstanceOf(RequestsCalculator::class, $calculator);
    }

    public function testCalculate()
    {
        $calculator = new RequestsCalculator(5000, 5);

        $this->assertSame($calculator->calculate(10000), 2);
    }

    public function testCalculateMaxRequests()
    {
        $calculator = new RequestsCalculator(5000, 5);

        $this->assertSame($calculator->calculate(100000), 5);
    }

    public function testCalculateOddFollowers()
    {
        $calculator = new RequestsCalculator(5000, 5);

        $this->assertSame($calculator->calculate(7500), 1);
    }

    public function testCalculateLowFollowers()
    {
        $calculator = new RequestsCalculator(5000, 5);

        $this->assertSame($calculator->calculate(2330), 1);
    }

    public function testCalculateZeroFollowers()
    {
        $calculator = new RequestsCalculator(5000, 5);

        $this->assertSame($calculator->calculate(0), 0);
    }

    public function testDivisionZero()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Cannot divide by zero, provide a division greater than zero.');
        $calculator = new RequestsCalculator(0, 5);
    }
}