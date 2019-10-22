<?php

namespace App\Fakers\Followers\Checks;

use App\TwitterMapper\Object\User;
use App\Fakers\Followers\Answers\Answer;

class Good
{
    public function hasFollowers(User $user): Answer
    {
        return $user->getFollowersCount() > 50 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasHighFollowers(User $user): Answer
    {
        return $user->getFollowersCount() > 200 ? $this->answerFactory(2, 2) : $this->answerFactory(0, 2);
    }

    public function hasFollowerFollowsRatio(User $user): Answer
    {
        return $user->getFollowerFollowsRatio() >= 20 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasHighFollowerFollowsRatio(User $user): Answer
    {
        return $user->getFollowerFollowsRatio() >= 60 ? $this->answerFactory(2, 2) : $this->answerFactory(0, 2);
    }

    public function hasTweetRate(User $user): Answer
    {
        return $user->getTweetsPerDayCount() >= 0.25 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasRecentLastTweet(User $user): Answer
    {
        return $user->getLastTweet()->getTweetAge() < 20 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasOldAccount(User $user): Answer
    {
        return $user->getAccountAgeDays() >= 90 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    private function answerFactory(int $actualScore, int $possibleScore): Answer
    {
        return new Answer('good', $actualScore, $possibleScore);
    }
}
