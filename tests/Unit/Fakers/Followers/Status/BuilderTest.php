<?php

namespace Tests\Unit\Faker\Follower;

use PHPUnit\Framework\TestCase;
use App\Fakers\Followers\Calculator;
use App\Fakers\Followers\Status\Builder;
use App\Fakers\Followers\Status\Status;
use Mockery as m;

class StatusBuilderTest extends TestCase
{
    public function testBuildStatus()
    {
        $score = m::mock(Calculator::class);

        $score->shouldReceive('getFakePercentage')->atLeast()->times(1)->andReturn(10);
        $score->shouldReceive('getInactivePercentage')->atLeast()->times(1)->andReturn(10);
        $score->shouldReceive('getGoodPercentage')->once()->andReturn(10);

        $status = new Builder($score);

        $this->assertInstanceOf(Status::class, $status->getStatus());
    }

    public function testStatusFake()
    {
        $score = m::mock(Calculator::class);

        $score->shouldReceive('getFakePercentage')->atLeast()->times(1)->andReturn(80);
        $score->shouldReceive('getInactivePercentage')->atLeast()->times(1)->andReturn(10);
        $score->shouldReceive('getGoodPercentage')->once()->andReturn(10);

        $status = new Builder($score);

        $result = $status->getStatus();

        $this->assertEquals('fake', $result->getStatusString());
        $this->assertEquals(80, $result->getFakeScore());
        $this->assertEquals(10, $result->getInactiveScore());
        $this->assertEquals(10, $result->getGoodScore());
    }

    public function testStatusInactive()
    {
        $score = m::mock(Calculator::class);

        $score->shouldReceive('getFakePercentage')->atLeast()->times(1)->andReturn(10);
        $score->shouldReceive('getInactivePercentage')->atLeast()->times(1)->andReturn(80);
        $score->shouldReceive('getGoodPercentage')->once()->andReturn(10);

        $status = new Builder($score);

        $result = $status->getStatus();

        $this->assertEquals('inactive', $result->getStatusString());
        $this->assertEquals(80, $result->getInactiveScore());
    }

    public function testStatusGood()
    {
        $score = m::mock(Calculator::class);

        $score->shouldReceive('getFakePercentage')->atLeast()->times(1)->andReturn(10);
        $score->shouldReceive('getInactivePercentage')->atLeast()->times(1)->andReturn(10);
        $score->shouldReceive('getGoodPercentage')->once()->andReturn(80);

        $status = new Builder($score);

        $result = $status->getStatus();

        $this->assertEquals('good', $result->getStatusString());
        $this->assertEquals(80, $result->getGoodScore());
    }
}
