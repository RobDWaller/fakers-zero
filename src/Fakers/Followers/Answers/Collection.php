<?php

namespace App\Fakers\Followers\Answers;

use App\Fakers\Followers\Answers\Answer;
use Doctrine\Common\Collections\ArrayCollection;

class Collection
{
    private $answers = [];

    public function getAnswers(): ArrayCollection
    {
        return new ArrayCollection($this->answers);
    }

    public function addAnswer(Answer $answer)
    {
        $this->answers[] = $answer;
    }
}
