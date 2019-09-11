<?php

namespace Tests\Helper;

use stdClass;
use Faker\Factory;

class FakeTweet
{
    public function getTweet()
    {
        $tweet = new stdClass;

        $faker = Factory::create();

        $tweet->id = $faker->randomNumber();
        $tweet->text = $faker->sentence;
        $tweet->created_at = $faker->date('Y-m-d', 'now') . ' ' . $faker->time('H:i:s');
        $tweet->retweet_count = $faker->randomNumber();
        $tweet->favorite_count = $faker->randomNumber();
        $tweet->retweeted = $faker->boolean;
        $tweet->favorited = $faker->boolean;
        $tweet->lang = $faker->languageCode;

        return $tweet;
    }

    public function getTweets(int $count): array
    {
        $i = 0;

        $tweets = [];

        while ($i < $count) {
            $tweets[] = $this->getTweet();

            $i++;
        }

        return $tweets;
    }
}
