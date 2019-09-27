<?php

namespace Tests\Unit\TwitterMapper;

use PHPUnit\Framework\TestCase;
use App\TwitterMapper\Object\User;
use App\TwitterMapper\Object\Tweet;
use App\TwitterMapper\Mapper;
use Tests\Helper\FakeTweet;
use Tests\Helper\FakeUser;
use Doctrine\Common\Collections\ArrayCollection;

class MapperTest extends TestCase
{
    public function testBuildTweet()
    {
        $mapper = new Mapper();

        $fakeTweet = new FakeTweet();

        $this->assertInstanceOf(Tweet::class, $mapper->buildTweet($fakeTweet->getTweet()));
    }

    public function testBuildTweets()
    {
        $mapper = new Mapper();

        $fakeTweet = new FakeTweet();

        $tweetCollection = $mapper->buildTweets($fakeTweet->getTweets(15));

        $this->assertInstanceOf(ArrayCollection::class, $tweetCollection);

        $this->assertInstanceOf(Tweet::class, $tweetCollection->first());
    }

    public function testBuildUser()
    {
        $mapper = new Mapper();

        $fakeUser = new FakeUser();

        $this->assertInstanceOf(User::class, $mapper->buildUser($fakeUser->getUser()));
    }

    public function testBuildUserWithoutStatus()
    {
        $mapper = new Mapper();

        $fakeUser = new FakeUser();

        $this->assertInstanceOf(User::class, $mapper->buildUser($fakeUser->getUser(), false));
    }

    public function testBuildUsers()
    {
        $mapper = new Mapper();

        $fakeUser = new FakeUser();

        $userCollection = $mapper->buildUsers($fakeUser->getUsers(20));

        $this->assertInstanceOf(ArrayCollection::class, $userCollection);

        $this->assertInstanceOf(User::class, $userCollection->first());
    }

    public function testBuildUsersWithoutStatus()
    {
        $mapper = new Mapper();

        $fakeUser = new FakeUser();

        $userCollection = $mapper->buildUsers($fakeUser->getUsers(20, false));

        $this->assertInstanceOf(ArrayCollection::class, $userCollection);

        $this->assertInstanceOf(User::class, $userCollection->first());
    }
}
