<?php

namespace Tests\Helper;

use stdClass;
use Tests\Helper\FakeTweet;
use Faker\Factory;

class FakeUser
{
    public function getUser(bool $withStatus = true)
    {
        $user = new stdClass;

        $faker = Factory::create();

        $tweet = new FakeTweet();

        $user->id = $faker->randomNumber();
        $user->screen_name = $faker->name;
        $user->location = $faker->city;
        $user->timezone = $faker->timezone;
        $user->description = $faker->sentence;
        $user->url = $faker->url;
        $user->protected = $faker->boolean;
        $user->followers_count = $faker->randomNumber();
        $user->friends_count = $faker->randomNumber();
        $user->listed_count = $faker->randomNumber();
        $user->created_at = $faker->date('Y-m-d', 'now') . ' ' . $faker->time('H:i:s');
        $user->favourites_count = $faker->randomNumber();
        $user->statuses_count = $faker->randomNumber();
        $user->lang = $faker->languageCode;
        if ($withStatus) {
            $user->status = $tweet->getTweet();
        }
        $user->profile_image_url_https = $faker->url;
        $user->following = $faker->boolean;

        return $user;
    }

    public function getUsers(int $count, $withStatus = true): array
    {
        $i = 0;

        $users = [];

        while ($i < $count) {
            $users[] = $this->getUser($withStatus);

            $i++;
        }

        return $users;
    }
}
