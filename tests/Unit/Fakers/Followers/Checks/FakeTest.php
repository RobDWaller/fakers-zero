<?php

namespace Tests\Unit\Fakers\Followers\Checks;

use PHPUnit\Framework\TestCase;
use App\Fakers\Followers\Checks\Fake;
use Mockery as m;
use App\TwitterMapper\Object\User;
use App\TwitterMapper\Object\Tweet;
use App\Fakers\Followers\Answers\Answer;

class FakeTest extends TestCase
{
    public function testHasLowFollowerFollowsRatio()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowerFollowsRatio')->once()->andReturn(19.9);

        $result = $fakeCheck->hasLowFollowerFollowsRatio($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(2, $result->getActualScore());
        $this->assertEquals(2, $result->getPossibleScore());
    }

    public function testHasLowFollowerFollowsRatioFalse()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowerFollowsRatio')->once()->andReturn(20.0);

        $result = $fakeCheck->hasLowFollowerFollowsRatio($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(2, $result->getPossibleScore());
    }

    public function testHasVeryLowFollowerFollowsRatio()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowerFollowsRatio')->once()->andReturn(2.0);

        $result = $fakeCheck->hasVeryLowFollowerFollowsRatio($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(3, $result->getActualScore());
        $this->assertEquals(3, $result->getPossibleScore());
    }

    public function testHasVeryLowFollowerFollowsRatioFalse()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowerFollowsRatio')->once()->andReturn(2.1);

        $result = $fakeCheck->hasVeryLowFollowerFollowsRatio($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(3, $result->getPossibleScore());
    }

    public function testHasFollowsCount()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowsCount')->once()->andReturn(50);

        $result = $fakeCheck->hasFollowsCount($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasFollowsCountFalse()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowsCount')->once()->andReturn(49);

        $result = $fakeCheck->hasFollowsCount($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasHighFollowsCount()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowsCount')->once()->andReturn(500);

        $result = $fakeCheck->hasHighFollowsCount($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(2, $result->getActualScore());
        $this->assertEquals(2, $result->getPossibleScore());
    }

    public function testHasHighFollowsCountFalse()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowsCount')->once()->andReturn(499);

        $result = $fakeCheck->hasHighFollowsCount($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(2, $result->getPossibleScore());
    }

    public function testHasLowFollowersCount()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowersCount')->once()->andReturn(49);

        $result = $fakeCheck->hasLowFollowersCount($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasLowFollowersCountFalse()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowersCount')->once()->andReturn(50);

        $result = $fakeCheck->hasLowFollowersCount($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasZeroFollowers()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowersCount')->once()->andReturn(0);

        $result = $fakeCheck->hasZeroFollowers($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasZeroFollowersFalse()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFollowersCount')->once()->andReturn(1);

        $result = $fakeCheck->hasZeroFollowers($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasZeroTweets()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getTweetsCount')->once()->andReturn(0);

        $result = $fakeCheck->hasZeroTweets($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasZeroTweetsFalse()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getTweetsCount')->once()->andReturn(1);

        $result = $fakeCheck->hasZeroTweets($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasZeroFavourites()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFavouritesCount')->once()->andReturn(0);

        $result = $fakeCheck->hasZeroFavourites($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasZeroFavouritesFalse()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getFavouritesCount')->once()->andReturn(1);

        $result = $fakeCheck->hasZeroFavourites($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasNoWebsite()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getWebsiteUrlString')->once()->andReturn('');

        $result = $fakeCheck->hasNoWebsite($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasNoWebsiteFalse()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getWebsiteUrlString')->once()->andReturn('car.com');

        $result = $fakeCheck->hasNoWebsite($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasLowTweetRate()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getTweetsPerDayCount')->once()->andReturn(0.24);

        $result = $fakeCheck->hasLowTweetRate($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(1, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }

    public function testHasLowTweetRateFalse()
    {
        $fakeCheck = new Fake;

        $user = m::mock(User::class);

        $user->shouldReceive('getTweetsPerDayCount')->once()->andReturn(0.25);

        $result = $fakeCheck->hasLowTweetRate($user);

        $this->assertInstanceOf(Answer::class, $result);

        $this->assertEquals('fake', $result->getType());
        $this->assertEquals(0, $result->getActualScore());
        $this->assertEquals(1, $result->getPossibleScore());
    }
}
