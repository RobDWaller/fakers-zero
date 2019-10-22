<?php

namespace App\Fakers\Followers\Answers;

use App\Fakers\Followers\Checks\Fake;
use App\Fakers\Followers\Checks\Inactive;
use App\Fakers\Followers\Checks\Good;
use App\TwitterMapper\Object\User;
use App\Fakers\Followers\Answers\Collection;

class Builder
{
    private $fake;

    private $inactive;

    private $good;

    public function __construct(Fake $fake, Inactive $inactive, Good $good)
    {
        $this->fake = $fake;

        $this->inactive = $inactive;

        $this->good = $good;
    }

    public function run(User $user)
    {
        $answers = new Collection();

        $this->runFakeChecks($user, $answers);

        $this->runInactiveChecks($user, $answers);

        $this->runGoodChecks($user, $answers);

        return $answers->getAnswers();
    }

    private function runFakeChecks(User $user, Collection $answers)
    {
        $answers->addAnswer($this->fake->hasLowFollowerFollowsRatio($user));

        $answers->addAnswer($this->fake->hasVeryLowFollowerFollowsRatio($user));

        $answers->addAnswer($this->fake->hasFollowsCount($user));

        $answers->addAnswer($this->fake->hasHighFollowsCount($user));

        $answers->addAnswer($this->fake->hasLowFollowersCount($user));

        $answers->addAnswer($this->fake->hasZeroFollowers($user));

        $answers->addAnswer($this->fake->hasZeroTweets($user));

        $answers->addAnswer($this->fake->hasZeroFavourites($user));

        $answers->addAnswer($this->fake->hasNoWebsite($user));

        $answers->addAnswer($this->fake->hasLowTweetRate($user));
    }

    private function runInactiveChecks(User $user, Collection $answers)
    {
        $answers->addAnswer($this->inactive->hasLowFollowers($user));

        $answers->addAnswer($this->inactive->hasLowFollows($user));

        $answers->addAnswer($this->inactive->hasLowTweets($user));

        $answers->addAnswer($this->inactive->hasLowTweetsPerDay($user));

        $answers->addAnswer($this->inactive->hasOldLastTweet($user));

        $answers->addAnswer($this->inactive->hasLowAccountAge($user));
    }

    private function runGoodChecks(User $user, Collection $answers)
    {
        $answers->addAnswer($this->good->hasFollowers($user));

        $answers->addAnswer($this->good->hasHighFollowers($user));

        $answers->addAnswer($this->good->hasFollowerFollowsRatio($user));

        $answers->addAnswer($this->good->hasHighFollowerFollowsRatio($user));

        $answers->addAnswer($this->good->hasTweetRate($user));

        $answers->addAnswer($this->good->hasRecentLastTweet($user));

        $answers->addAnswer($this->good->hasOldAccount($user));
    }
}
