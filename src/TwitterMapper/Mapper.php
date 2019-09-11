<?php

namespace App\TwitterMapper;

use App\TwitterMapper\Object\Tweet;
use App\TwitterMapper\Object\User;
use Illuminate\Support\Collection;

class Mapper
{
    public function buildTweet($tweet): Tweet
    {
        return new Tweet(
            $tweet->id,
            $tweet->text,
            $tweet->created_at,
            $tweet->retweet_count,
            $tweet->favorite_count,
            $tweet->retweeted,
            $tweet->favorited,
            $tweet->lang
        );
    }

    public function buildTweets(array $tweets): Collection
    {
        $collectionArray = [];

        foreach ($tweets as $tweet) {
            $collectionArray[] = $this->buildTweet($tweet);
        }

        return new Collection($collectionArray);
    }

    public function buildUser($user): User
    {
        $userObject = new User(
            $user->id,
            $user->screen_name,
            $user->location,
            $user->timezone,
            $user->description,
            $user->url,
            $user->protected,
            $user->followers_count,
            $user->friends_count,
            $user->listed_count,
            $user->created_at,
            $user->favourites_count,
            $user->statuses_count,
            $user->lang,
            $user->profile_image_url_https,
            $user->following
        );

        if (isset($user->status)) {
            $userObject->setLastTweet($this->buildTweet($user->status));
        }

        return $userObject;
    }

    public function buildUsers(array $users): Collection
    {
        $collectionArray = [];

        foreach ($users as $user) {
            $collectionArray[] = $this->buildUser($user);
        }

        return new Collection($collectionArray);
    }
}
