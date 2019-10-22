<?php

namespace Tests\Unit\Fakers\Followers\Checks;

use PHPUnit\Framework\TestCase;
use App\Fakers\Followers\Checks\Good;
use App\Fakers\Followers\Answers\Answer;
use App\TwitterMapper\Object\User;
use App\TwitterMapper\Object\Tweet;
use Mockery as m;
use Carbon\Carbon;

class GoodTest extends TestCase
{
    public function testHasFollowers()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowersCount')->once()->andReturn(51);

        $result = $goodCheck->hasFollowers($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasFollowersFalse()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowersCount')->once()->andReturn(50);

        $result = $goodCheck->hasFollowers($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasHighFollowers()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowersCount')->once()->andReturn(201);

        $result = $goodCheck->hasHighFollowers($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(2, $result->getActualScore());
        $this->assertEquals(2, $result->getPossibleScore());
    }

    public function testHasHighFollowersFalse()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowersCount')->once()->andReturn(200);

        $result = $goodCheck->hasHighFollowers($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(2, $result->getPossibleScore());
    }

    public function testHasFollowerFollowsRatio()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowerFollowsRatio')->once()->andReturn(20);

        $result = $goodCheck->hasFollowerFollowsRatio($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasFollowerFollowsRatioFalse()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowerFollowsRatio')->once()->andReturn(19);

        $result = $goodCheck->hasFollowerFollowsRatio($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasHighFollowerFollowsRatio()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowerFollowsRatio')->once()->andReturn(60);

        $result = $goodCheck->hasHighFollowerFollowsRatio($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(2, $result->getActualScore());
        $this->assertEquals(2, $result->getPossibleScore());
    }

    public function testHasHighFollowerFollowsRatioFalse()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowerFollowsRatio')->once()->andReturn(59);

        $result = $goodCheck->hasHighFollowerFollowsRatio($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(2, $result->getPossibleScore());
    }

    public function testHasTweetRate()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getTweetsPerDayCount')->once()->andReturn(0.25);

        $result = $goodCheck->hasTweetRate($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasTweetRateFalse()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getTweetsPerDayCount')->once()->andReturn(0.24);

        $result = $goodCheck->hasTweetRate($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasRecentLastTweet()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getLastTweet')->once()->andReturn(
            new Tweet(
                123123456456789789,
                'Hello World',
                Carbon::now()->subDays(19)->toDateTimeString(),
                10,
                5,
                true,
                false,
                'en'
            )
        );

        $result = $goodCheck->hasRecentLastTweet($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasRecentLastTweetFalse()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getLastTweet')->once()->andReturn(
            new Tweet(
                123123456456789789,
                'Hello World',
                Carbon::now()->subDays(20)->toDateTimeString(),
                10,
                5,
                true,
                false,
                'en'
            )
        );

        $result = $goodCheck->hasRecentLastTweet($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasOldAccount()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getAccountAgeDays')->once()->andReturn(90);

        $result = $goodCheck->hasOldAccount($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasOldAccountFalse()
    {
        $goodCheck = new Good();

        $user = m::mock(User::class);

        $user->shouldReceive('getAccountAgeDays')->once()->andReturn(89);

        $result = $goodCheck->hasOldAccount($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('good', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }
}
