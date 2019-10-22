<?php

namespace App\Fakers;

use Doctrine\Common\Collections\ArrayCollection;
use App\Fakers\Score;
use App\Fakers\Followers\Answers\Builder as AnswerBuilder;
use App\Fakers\Followers\Status\Collection as StatusCollection;
use App\Fakers\Followers\Status\Builder as StatusBuilder;
use App\Fakers\Followers\Calculator;
use App\Fakers\Followers\Checks\Fake;
use App\Fakers\Followers\Checks\Inactive;
use App\Fakers\Followers\Checks\Good;

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
        $answerBuilder = new AnswerBuilder(new Fake(), new Inactive(), new Good());

        $statuses = new StatusCollection();

        foreach ($this->followers as $follower) {
            $answerCollection = $answerBuilder->run($follower);

            $result = new Calculator($answerCollection);

            $status = new StatusBuilder($result);

            $statuses->addStatus($status->getStatus());
        }

        return new Score($statuses);
    }
}
