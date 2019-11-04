<?php

namespace App\Fakers;

use Doctrine\Common\Collections\ArrayCollection;
use App\Fakers\Score;
use App\Fakers\Followers\Checks\Checker;
use App\Fakers\Followers\Checks\Checks;
use App\Fakers\Followers\Checks\Callbacks;
use App\Fakers\Followers\Status\Collection as StatusCollection;
use App\Fakers\Followers\Status\Builder as StatusBuilder;
use App\Fakers\Followers\Calculator;

/**
 * Run the Faker Score calculation process.
 */
class Fakers
{
    private $followers;

    /**
     * Load a collection of Twitter followers.
     */
    public function __construct(ArrayCollection $followers)
    {
        $this->followers = $followers;
    }

    /**
     * Each follower is asked a number of questions the answers to these
     * questions define what its Faker Status is. A collection of statuses is
     * built up and this allows us to calculate an overall Faker Score for the
     * Twitter account.
     */
    public function getFakerScore(): Score
    {
        $checker = new Checker(new Checks(), new Callbacks());

        $statuses = new StatusCollection();

        foreach ($this->followers as $follower) {
            $answers = $checker->check($follower);

            $result = new Calculator($answers);

            $status = new StatusBuilder($result);

            $statuses->addStatus($status->getStatus());
        }

        return new Score($statuses);
    }
}
