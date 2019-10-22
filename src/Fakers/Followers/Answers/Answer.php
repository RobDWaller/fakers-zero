<?php

namespace App\Fakers\Followers\Answers;

class Answer
{
    private $type;

    private $actualScore;

    private $possibleScore;

    public function __construct(string $type, int $actualScore, int $possibleScore)
    {
        $this->type = $type;

        $this->actualScore = $actualScore;

        $this->possibleScore = $possibleScore;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getActualScore()
    {
        return $this->actualScore;
    }

    public function getPossibleScore()
    {
        return $this->possibleScore;
    }
}
