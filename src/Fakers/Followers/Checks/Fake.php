<?php

namespace App\Fakers\Followers\Checks;

use App\TwitterMapper\Object\User;
use App\Fakers\Followers\Answers\Answer;

class Fake
{
    public function hasLowFollowerFollowsRatio(User $user): Answer
    {
        return $user->getFollowerFollowsRatio() < 20 ? $this->answerFactory(2, 2) : $this->answerFactory(0, 2);
    }

    public function hasVeryLowFollowerFollowsRatio(User $user): Answer
    {
        return $user->getFollowerFollowsRatio() <= 2 ? $this->answerFactory(3, 3) : $this->answerFactory(0, 3);
    }

    public function hasFollowsCount(User $user): Answer
    {
        return $user->getFollowsCount() >= 50 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasHighFollowsCount(User $user): Answer
    {
        return $user->getFollowsCount() >= 500 ? $this->answerFactory(2, 2) : $this->answerFactory(0, 2);
    }

    public function hasLowFollowersCount(User $user): Answer
    {
        return $user->getFollowersCount() < 50 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasZeroFollowers(User $user): Answer
    {
        return $user->getFollowersCount() === 0 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasZeroTweets(User $user): Answer
    {
        return $user->getTweetsCount() === 0 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasZeroFavourites(User $user): Answer
    {
        return $user->getFavouritesCount() === 0 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasNoWebsite(User $user): Answer
    {
        return empty($user->getWebsiteUrlString()) ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    public function hasLowTweetRate(User $user): Answer
    {
        return $user->getTweetsPerDayCount() < 0.25 ? $this->answerFactory(1, 1) : $this->answerFactory(0, 1);
    }

    private function answerFactory(int $actualScore, int $possibleScore): Answer
    {
        return new Answer('fake', $actualScore, $possibleScore);
    }
}
