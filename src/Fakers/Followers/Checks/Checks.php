<?php

declare(strict_types = 1);

namespace App\Fakers\Followers\Checks;

class Checks
{
    public function getChecks(): array
    {
        return [
            [
                'answerType' => 'fake',
                'question' => 'FollowerFollowsRatio',
                'comparison' => 20,
                'possibleScore' => 2,
                'callback' => '<'
            ],
            [
                'answerType' => 'fake',
                'question' => 'FollowerFollowsRatio',
                'comparison' => 2,
                'possibleScore' => 3,
                'callback' => '<='
            ],
            [
                'answerType' => 'fake',
                'question' => 'FollowsCount',
                'comparison' => 50,
                'possibleScore' => 1,
                'callback' => '>='
            ],
            [
                'answerType' => 'fake',
                'question' => 'FollowsCount',
                'comparison' => 500,
                'possibleScore' => 2,
                'callback' => '>='
            ],
            [
                'answerType' => 'fake',
                'question' => 'FollowersCount',
                'comparison' => 50,
                'possibleScore' => 1,
                'callback' => '<'
            ],
            [
                'answerType' => 'fake',
                'question' => 'FollowersCount',
                'comparison' => 0,
                'possibleScore' => 1,
                'callback' => '==='
            ],
            [
                'answerType' => 'fake',
                'question' => 'TweetsCount',
                'comparison' => 0,
                'possibleScore' => 1,
                'callback' => '==='
            ],
            [
                'answerType' => 'fake',
                'question' => 'FavouritesCount',
                'comparison' => 0,
                'possibleScore' => 1,
                'callback' => '==='
            ],
            [
                'answerType' => 'fake',
                'question' => 'WebsiteUrlString',
                'comparison' => null,
                'possibleScore' => 1,
                'callback' => 'empty'
            ],
            [
                'answerType' => 'fake',
                'question' => 'TweetsPerDayCount',
                'comparison' => 0.25,
                'possibleScore' => 1,
                'callback' => '<'
            ],
            [
                'answerType' => 'good',
                'question' => 'FollowersCount',
                'comparison' => 50,
                'possibleScore' => 1,
                'callback' => '>'
            ],
            [
                'answerType' => 'good',
                'question' => 'FollowersCount',
                'comparison' => 200,
                'possibleScore' => 2,
                'callback' => '>'
            ],
            [
                'answerType' => 'good',
                'question' => 'FollowerFollowsRatio',
                'comparison' => 20,
                'possibleScore' => 1,
                'callback' => '>='
            ],
            [
                'answerType' => 'good',
                'question' => 'FollowerFollowsRatio',
                'comparison' => 60,
                'possibleScore' => 2,
                'callback' => '>='
            ],
            [
                'answerType' => 'good',
                'question' => 'TweetsPerDayCount',
                'comparison' => 0.25,
                'possibleScore' => 2,
                'callback' => '>='
            ],
            [
                'answerType' => 'good',
                'question' => 'TweetAge',
                'comparison' => 20,
                'possibleScore' => 1,
                'callback' => '<'
            ],
            [
                'answerType' => 'good',
                'question' => 'AccountAgeDays',
                'comparison' => 90,
                'possibleScore' => 2,
                'callback' => '>='
            ],
            [
                'answerType' => 'inactive',
                'question' => 'FollowersCount',
                'comparison' => 20,
                'possibleScore' => 1,
                'callback' => '<'
            ],
            [
                'answerType' => 'inactive',
                'question' => 'FollowsCount',
                'comparison' => 20,
                'possibleScore' => 1,
                'callback' => '<'
            ],
            [
                'answerType' => 'inactive',
                'question' => 'TweetsCount',
                'comparison' => 20,
                'possibleScore' => 1,
                'callback' => '<'
            ],
            [
                'answerType' => 'inactive',
                'question' => 'TweetsPerDayCount',
                'comparison' => 0.1,
                'possibleScore' => 2,
                'callback' => '<'
            ],
            [
                'answerType' => 'inactive',
                'question' => 'TweetAge',
                'comparison' => 90,
                'possibleScore' => 2,
                'callback' => '>='
            ],
            [
                'answerType' => 'inactive',
                'question' => 'FollowerFollowsRatio',
                'comparison' => 20,
                'possibleScore' => 2,
                'callback' => '<'
            ],
        ];
    }
}