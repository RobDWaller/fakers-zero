<?php

namespace Tests\Unit\TwitterMapper\Object;

use PHPUnit\Framework\TestCase;
use App\TwitterMapper\Object\Tweet;
use Carbon\Carbon;

class TweetTest extends TestCase
{
    public function testGetId()
    {
        $tweet = new Tweet(123, 'Hello World', '2017-12-17 19:06:52', 10, 5, true, false, 'en');

        $this->assertEquals($tweet->getId(), 123);
    }

    public function testGetText()
    {
        $tweet = new Tweet(123, 'Hello World', '2017-12-17 19:06:52', 10, 5, true, false, 'en');

        $this->assertEquals($tweet->getText(), 'Hello World');
    }

    public function testGetCreatedAt()
    {
        $tweet = new Tweet(123, 'Hello World', '2017-12-17 19:06:52', 10, 5, true, false, 'en');

        $this->assertInstanceOf(Carbon::class, $tweet->getCreatedAt());
        $this->assertEquals($tweet->getCreatedAt(), '2017-12-17 19:06:52');
    }

    /**
     * @expectedException Exception
     */
    public function testCreatedAtBadDateString()
    {
        $tweet = new Tweet(123, 'Hello World', '4', 10, 5, true, false, 'en');

        $tweet->getCreatedAt();
    }

    public function testGetRetweetCount()
    {
        $tweet = new Tweet(123, 'Hello World', '2017-12-17 19:06:52', 10, 5, true, false, 'en');

        $this->assertEquals($tweet->getRetweetCount(), 10);
    }

    public function testGetFavouriteCount()
    {
        $tweet = new Tweet(123, 'Hello World', '2017-12-17 19:06:52', 10, 5, true, false, 'en');

        $this->assertEquals($tweet->getFavouriteCount(), 5);
    }

    public function testGetRetweeted()
    {
        $tweet = new Tweet(123, 'Hello World', '2017-12-17 19:06:52', 10, 5, true, false, 'en');

        $this->assertEquals($tweet->getRetweeted(), true);
    }

    public function testGetFavourited()
    {
        $tweet = new Tweet(123, 'Hello World', '2017-12-17 19:06:52', 10, 5, true, false, 'en');

        $this->assertEquals($tweet->getFavourited(), false);
    }

    public function testGetLanguage()
    {
        $tweet = new Tweet(123, 'Hello World', '2017-12-17 19:06:52', 10, 5, true, false, 'en');

        $this->assertEquals($tweet->getLanguage(), 'en');
    }

    public function testBigIntId()
    {
        $tweet = new Tweet(
            123123456456789789,
            'Hello World',
            '2017-12-17 19:06:52',
            10,
            5,
            true,
            false,
            'en'
        );

        $this->assertEquals($tweet->getId(), 123123456456789789);
    }

    public function testGetTweetAge()
    {
        $tweet = new Tweet(
            123123456456789789,
            'Hello World',
            Carbon::now()->subDays(10)->toDateTimeString(),
            10,
            5,
            true,
            false,
            'en'
        );

        $this->assertEquals($tweet->getTweetAge(), 10);
    }
}
