<?php

namespace Tests\Unit\Fakers;

use PHPUnit\Framework\TestCase;
use App\Fakers\Score;
use App\Fakers\Followers\Status\Collection;
use Tests\Helper\FakeStatus;

class ScoreTest extends TestCase
{
    public function testBuildScore()
    {
        $statusCollection = new Collection;

        $fakeStatus = new FakeStatus;

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertInstanceOf(Score::class, $score);
    }

    public function testGetTotalCount()
    {
        $statusCollection = new Collection;

        $fakeStatus = new FakeStatus;

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertTrue(is_int($score->getTotalCount()));
    }

    public function testGetFakeCount()
    {
        $statusCollection = new Collection;

        $fakeStatus = new FakeStatus;

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertTrue(is_int($score->getFakeCount()));
    }

    public function testGetInactiveCount()
    {
        $statusCollection = new Collection;

        $fakeStatus = new FakeStatus;

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertTrue(is_int($score->getInactiveCount()));
    }

    public function testGetGoodCount()
    {
        $statusCollection = new Collection;

        $fakeStatus = new FakeStatus;

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertTrue(is_int($score->getGoodCount()));
    }

    public function testGetFakeScore()
    {
        $statusCollection = new Collection;

        $fakeStatus = new FakeStatus;

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertTrue(is_int($score->getFakeScore()));
        $this->assertLessThanOrEqual(100, $score->getFakeScore());
    }

    public function testGetInactiveScore()
    {
        $statusCollection = new Collection;

        $fakeStatus = new FakeStatus;

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
        $statusCollection = new Collection;

        $fakeStatus = new FakeStatus;

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
        $statusCollection = new Collection;

        $fakeStatus = new FakeStatus;

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $score = new Score($statusCollection);

        $this->assertEquals(100, ($score->getFakeScore() + $score->getInactiveScore() + $score->getGoodScore()));
    }
}
