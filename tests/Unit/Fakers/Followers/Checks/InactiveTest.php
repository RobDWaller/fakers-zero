<?php

namespace Tests\Unit\Fakers\Followers\Checks;

use PHPUnit\Framework\TestCase;
use App\Fakers\Followers\Checks\Inactive;
use App\Fakers\Followers\Answers\Answer;
use App\TwitterMapper\Object\User;
use App\TwitterMapper\Object\Tweet;
use Mockery as m;
use Carbon\Carbon;

class InactiveTest extends TestCase
{
    public function testHasLowFollowers()
    {
        $inactiveCheck = new Inactive();

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowersCount')->once()->andReturn(19);

        $result = $inactiveCheck->hasLowFollowers($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('inactive', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasLowFollowersFalse()
    {
        $inactiveCheck = new Inactive();

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowersCount')->once()->andReturn(20);

        $result = $inactiveCheck->hasLowFollowers($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('inactive', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasLowFollows()
    {
        $inactiveCheck = new Inactive();

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowsCount')->once()->andReturn(19);

        $result = $inactiveCheck->hasLowFollows($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('inactive', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasLowFollowsFalse()
    {
        $inactiveCheck = new Inactive();

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowsCount')->once()->andReturn(20);

        $result = $inactiveCheck->hasLowFollows($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('inactive', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasLowTweets()
    {
        $inactiveCheck = new Inactive();

        $user = m::mock(User::class);

        $user->shouldReceive('getTweetsCount')->once()->andReturn(19);

        $result = $inactiveCheck->hasLowTweets($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('inactive', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasLowTweetsFalse()
    {
        $inactiveCheck = new Inactive();

        $user = m::mock(User::class);

        $user->shouldReceive('getTweetsCount')->once()->andReturn(20);

        $result = $inactiveCheck->hasLowTweets($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('inactive', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasLowTweetsPerDay()
    {
        $inactiveCheck = new Inactive();

        $user = m::mock(User::class);

        $user->shouldReceive('getTweetsPerDayCount')->once()->andReturn(0.10);

        $result = $inactiveCheck->hasLowTweetsPerDay($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('inactive', $result->getType());
        $this->assertEquals(2, $result->getActualScore());
        $this->assertEquals(2, $result->getPossibleScore());
    }

    public function testHasLowTweetsPerDayFalse()
    {
        $inactiveCheck = new Inactive();

        $user = m::mock(User::class);

        $user->shouldReceive('getTweetsPerDayCount')->once()->andReturn(0.11);

        $result = $inactiveCheck->hasLowTweetsPerDay($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('inactive', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(2, $result->getPossibleScore());
    }

    public function testHasOldLastTweet()
    {
        $inactiveCheck = new Inactive();

        $user = m::mock(User::class);

        $user->shouldReceive('getLastTweet')->once()->andReturn(
            new Tweet(
                123123456456789789,
                'Hello World',
                Carbon::now()->subDays(90)->toDateTimeString(),
                10,
                5,
                true,
                false,
                'en'
            )
        );

        $result = $inactiveCheck->hasOldLastTweet($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('inactive', $result->getType());
        $this->assertEquals(2, $result->getActualScore());
        $this->assertEquals(2, $result->getPossibleScore());
    }

    public function testHasOldLastTweetFalse()
    {
        $inactiveCheck = new Inactive();

        $user = m::mock(User::class);

        $user->shouldReceive('getLastTweet')->once()->andReturn(
            new Tweet(
                123123456456789789,
                'Hello World',
                Carbon::now()->subDays(89)->toDateTimeString(),
                10,
                5,
                true,
                false,
                'en'
            )
        );

        $result = $inactiveCheck->hasOldLastTweet($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('inactive', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(2, $result->getPossibleScore());
    }

    public function testHasLowAccountAge()
    {
        $inactiveCheck = new Inactive();

        $user = m::mock(User::class);

        $user->shouldReceive('getAccountAgeDays')->once()->andReturn(44);

        $result = $inactiveCheck->hasLowAccountAge($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('inactive', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasLowAccountAgeFalse()
    {
        $inactiveCheck = new Inactive();

        $user = m::mock(User::class);

        $user->shouldReceive('getAccountAgeDays')->once()->andReturn(45);

        $result = $inactiveCheck->hasLowAccountAge($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('inactive', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }
}
