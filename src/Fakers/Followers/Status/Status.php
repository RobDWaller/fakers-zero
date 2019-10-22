<?php

namespace App\Fakers\Followers\Status;

class Status
{
    private $status;

    private $fakeScore;

    private $inactiveScore;

    private $goodScore;

    public function __construct(string $status, float $fakeScore, float $inactiveScore, float $goodScore)
    {
        $this->status = $status;

        $this->fakeScore = $fakeScore;

        $this->inactiveScore = $inactiveScore;

        $this->goodScore = $goodScore;
    }

    public function getStatusString(): string
    {
        return $this->status;
    }

    public function getFakeScore(): float
    {
        return $this->fakeScore;
    }

    public function getInactiveScore(): float
    {
        return $this->inactiveScore;
    }

    public function getGoodScore(): float
    {
        return $this->goodScore;
    }
}
