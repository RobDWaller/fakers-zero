<?php

namespace App\Fakers;

use App\Fakers\Followers\Status\Collection;

/**
 * The Faker Score Object. Load a collection of Faker Statuses which is a list
 * of Followers which have been defined as Good, Fake or Inactive. The class
 * then allows us to retrieve overall Good, Fake, and Inactive counts for the
 * Twitter account along with calculating the percentage scores for Good, Fake
 * and Interactive.
 */
class Score
{
    private $statuses;

    public function __construct(Collection $statuses)
    {
        $this->statuses = $statuses->getStatuses();
    }

    public function getTotalCount(): int
    {
        return $this->statuses->count();
    }

    public function getFakeCount(): int
    {
        $fake = $this->statuses->filter(function ($follower) {
            return $follower->getStatusString() === 'fake';
        });

        return $fake->count();
    }

    public function getInactiveCount(): int
    {
        $inactive = $this->statuses->filter(function ($follower) {
            return $follower->getStatusString() === 'inactive';
        });

        return $inactive->count();
    }

    public function getGoodCount(): int
    {
        $good = $this->statuses->filter(function ($follower) {
            return $follower->getStatusString() === 'good';
        });

        return $good->count();
    }

    public function getFakeScore(): int
    {
        return (int) round(($this->getFakeCount() / $this->getTotalCount()) * 100, 0);
    }

    public function getInactiveScore(): int
    {
        return (int) round(($this->getInactiveCount() / $this->getTotalCount()) * 100, 0);
    }

    public function getGoodScore(): int
    {
        return 100 - ($this->getFakeScore() + $this->getInactiveScore());
    }
}
