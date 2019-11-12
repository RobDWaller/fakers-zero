<?php

namespace Tests\Unit\Fakers;

use PHPUnit\Framework\TestCase;
use App\Fakers\Score;
use App\Fakers\Followers\Status\Collection;
use App\Fakers\Followers\Status\Status;
use Tests\Helper\FakeStatus;
use Mockery as m;

class ScoreTest extends TestCase
{
    public function testBuildScore()
    {
        $statusCollection = new Collection();

        $fakeStatus = new FakeStatus();

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertInstanceOf(Score::class, $score);
    }

    public function testGetTotalCount()
    {
        $statusCollection = new Collection();

        $fakeStatus = new FakeStatus();

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertTrue(is_int($score->getTotalCount()));
    }

    public function testGetFakeCount()
    {
        $statusCollection = new Collection();

        $status1 = m::mock(Status::class);
        $status1->shouldReceive('getStatusString')
            ->once()
            ->andReturn('fake');

        $status2 = m::mock(Status::class);
        $status2->shouldReceive('getStatusString')
            ->once()
            ->andReturn('fake');

        $status3 = m::mock(Status::class);
        $status3->shouldReceive('getStatusString')
            ->once()
            ->andReturn('fake');

        $statusCollection->addStatus($status1);
        $statusCollection->addStatus($status2);
        $statusCollection->addStatus($status3);

        $score = new Score($statusCollection);

        $this->assertSame($score->getFakeCount(), 3);
    }

    public function testGetInactiveCount()
    {
        $statusCollection = new Collection();

        $status1 = m::mock(Status::class);
        $status1->shouldReceive('getStatusString')
            ->once()
            ->andReturn('fake');

        $status2 = m::mock(Status::class);
        $status2->shouldReceive('getStatusString')
            ->once()
            ->andReturn('inactive');

        $status3 = m::mock(Status::class);
        $status3->shouldReceive('getStatusString')
            ->once()
            ->andReturn('good');

        $statusCollection->addStatus($status1);
        $statusCollection->addStatus($status2);
        $statusCollection->addStatus($status3);

        $score = new Score($statusCollection);

        $this->assertSame($score->getInactiveCount(), 1);
    }

    public function testGetGoodCount()
    {
        $statusCollection = new Collection();

        $status1 = m::mock(Status::class);
        $status1->shouldReceive('getStatusString')
            ->once()
            ->andReturn('fake');

        $status2 = m::mock(Status::class);
        $status2->shouldReceive('getStatusString')
            ->once()
            ->andReturn('good');

        $status3 = m::mock(Status::class);
        $status3->shouldReceive('getStatusString')
            ->once()
            ->andReturn('good');

        $statusCollection->addStatus($status1);
        $statusCollection->addStatus($status2);
        $statusCollection->addStatus($status3);

        $score = new Score($statusCollection);

        $this->assertSame($score->getGoodCount(), 2);
    }

    public function testGetFakeScore()
    {
        $statusCollection = new Collection();

        $fakeStatus = new FakeStatus();

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertTrue(is_int($score->getFakeScore()));
        $this->assertLessThanOrEqual(100, $score->getFakeScore());
    }

    public function testGetScores()
    {
        $statusCollection = new Collection();

        $status1 = m::mock(Status::class);
        $status1->shouldReceive('getStatusString')
            ->times(4)
            ->andReturn('fake');

        $status2 = m::mock(Status::class);
        $status2->shouldReceive('getStatusString')
            ->times(4)
            ->andReturn('good');

        $statusCollection->addStatus($status1);
        $statusCollection->addStatus($status2);

        $score = new Score($statusCollection);
        $this->assertSame($score->getFakeScore(), 50);
        $this->assertSame($score->getGoodScore(), 50);
        $this->assertSame($score->getInactiveScore(), 0);
    }

    public function testGetScoresInactive()
    {
        $statusCollection = new Collection();

        $status1 = m::mock(Status::class);
        $status1->shouldReceive('getStatusString')
            ->times(4)
            ->andReturn('inactive');

        $status2 = m::mock(Status::class);
        $status2->shouldReceive('getStatusString')
            ->times(4)
            ->andReturn('inactive');

        $statusCollection->addStatus($status1);
        $statusCollection->addStatus($status2);

        $score = new Score($statusCollection);
        $this->assertSame($score->getFakeScore(), 0);
        $this->assertSame($score->getGoodScore(), 0);
        $this->assertSame($score->getInactiveScore(), 100);
    }

    public function testGetScoresThree()
    {
        $statusCollection = new Collection();

        $status1 = m::mock(Status::class);
        $status1->shouldReceive('getStatusString')
            ->times(4)
            ->andReturn('fake');

        $status2 = m::mock(Status::class);
        $status2->shouldReceive('getStatusString')
            ->times(4)
            ->andReturn('good');

        $status3 = m::mock(Status::class);
        $status3->shouldReceive('getStatusString')
            ->times(4)
            ->andReturn('inactive');

        $statusCollection->addStatus($status1);
        $statusCollection->addStatus($status2);
        $statusCollection->addStatus($status3);

        $score = new Score($statusCollection);
        $this->assertSame($score->getFakeScore(), 33);
        $this->assertSame($score->getGoodScore(), 34);
        $this->assertSame($score->getInactiveScore(), 33);
    }

    public function testGetInactiveScore()
    {
        $statusCollection = new Collection();

        $fakeStatus = new FakeStatus();

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertTrue(is_int($score->getInactiveScore()));
        $this->assertLessThanOrEqual(100, $score->getInactiveScore());
    }

    public function testGetGoodScore()
    {
        $statusCollection = new Collection();

        $fakeStatus = new FakeStatus();

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertTrue(is_int($score->getGoodScore()));
        $this->assertLessThanOrEqual(100, $score->getGoodScore());
    }

    public function testScoresEqual100()
    {
        $statusCollection = new Collection();

        $fakeStatus = new FakeStatus();

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertEquals(100, ($score->getFakeScore() + $score->getInactiveScore() + $score->getGoodScore()));
    }

    public function tearDown(): void
    {
        m::close();
    }
}
