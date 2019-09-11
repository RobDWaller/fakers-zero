<?php

namespace Tests\Unit\TwitterMapper\Object;

use PHPUnit\Framework\TestCase;
use App\TwitterMapper\Object\User;
use App\TwitterMapper\Object\Tweet;
use Carbon\Carbon;

class UserTest extends TestCase
{
    public function testGetTwitterId()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getTwitterId(), 1234);
    }

    public function testBigIntTwitterId()
    {
        $user = new User(
            1234938374982938287,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getTwitterId(), 1234938374982938287);
    }

    public function testGetHandle()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getHandle(), 'RobDWaller');
    }

    public function testGetLocation()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getLocation(), 'London');
    }

    public function testGetTimeZone()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getTimeZone(), 'Europe/London');
    }

    public function testGetDescription()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getDescription(), 'Great Guy..?');
    }

    public function testGetWebsiteUrlString()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getWebsiteUrlString(), 'http://rob.com');
    }

    public function testGetPrivateAccount()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getPrivateAccount(), false);
    }

    public function testGetFollowersCount()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getFollowersCount(), 100);
    }

    public function testGetFollowsCount()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getFollowsCount(), 211);
    }

    public function testGetListedCount()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getListedCount(), 2);
    }

    public function testGetCreatedAt()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertInstanceOf(Carbon::class, $user->getCreatedAt());
        $this->assertEquals($user->getCreatedAt()->toDateTimeString(), Carbon::now()->subDays(10)->toDateTimeString());
    }

    public function testGetAccountAgeDays()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getAccountAgeDays(), 10);
    }

    public function testGetFavouritesCount()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getFavouritesCount(), 25);
    }

    public function testGetTweetsCount()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getTweetsCount(), 76);
    }

    public function testGetTweetsPerDayCount()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getTweetsPerDayCount(), 7.6);
    }

    public function testGetLanguage()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getLanguage(), 'en');
    }

    public function testGetAvatarUrlString()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getAvatarUrlString(), 'http://image.com/asdasd.jpg');
    }

    public function testGetIsFollowing()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getIsFollowing(), false);
    }

    public function testGetFollowerFollowsRatio()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            9,
            100,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getFollowerFollowsRatio(), 9);
    }

    public function testGetFollowerFollowsRatioDivideByZero()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            9,
            0,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getFollowerFollowsRatio(), 0);
    }

    public function testGetFollowerFollowsRatioDivideByZeroTwo()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            0,
            10,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getFollowerFollowsRatio(), 0);
    }

    public function testGetFollowerFollowsRatioDivideByZeroThree()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            0,
            0,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $this->assertEquals($user->getFollowerFollowsRatio(), 0);
    }

    public function testSetLastTweet()
    {
        $user = new User(
            1234,
            'RobDWaller',
            'London',
            'Europe/London',
            'Great Guy..?',
            'http://rob.com',
            false,
            100,
            211,
            2,
            Carbon::now()->subDays(10)->toDateTimeString(),
            25,
            76,
            'en',
            'http://image.com/asdasd.jpg',
            false
        );

        $user->setLastTweet(new Tweet(
            12345,
            'Hello World!',
            Carbon::now()->subDays(3)->toDateTimeString(),
            2,
            1,
            true,
            false,
            'en'
        ));

        $this->assertInstanceOf(Tweet::class, $user->getLastTweet());
    }
}
