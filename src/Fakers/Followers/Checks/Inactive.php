<?php

namespace App\Fakers\Followers\Checks;

use App\TwitterMapper\Object\User;
use App\Fakers\Followers\Answers\Answer;

class Inactive
{
    public function hasLowFollowers(User $user): Answer
    {
        return $user->getFollowersCount() < 20 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasLowFollows(User $user): Answer
    {
        return $user->getFollowsCount() < 20 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasLowTweets(User $user): Answer
    {
        return $user->getTweetsCount() < 20 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasLowTweetsPerDay(User $user): Answer
    {
        return $user->getTweetsPerDayCount() <= 0.1 ? $this->answerFactory(2, 2) : $this->answerFactory(0, 2);
    }

    public function hasOldLastTweet(User $user): Answer
    {
        return $user->getLastTweet()->getTweetAge() >= 90 ? $this->answerFactory(2, 2) : $this->answerFactory(0, 2);
    }

    public function hasLowAccountAge(User $user): Answer
    {
        return $user->getAccountAgeDays() < 45 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    private function answerFactory(int $actualScore, int $possibleScore): Answer
    {
        return new Answer('inactive', $actualScore, $possibleScore);
    }
}
