<?php

namespace App\Fakers\Followers\Status;

use App\Fakers\Followers\Calculator;
use App\Fakers\Followers\Status\Status;

class Builder
{
    private $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function getStatus(): Status
    {
        return new Status(
            $this->getStatusString(),
            $this->calculator->getFakePercentage(),
            $this->calculator->getInactivePercentage(),
            $this->calculator->getGoodPercentage()
        );
    }

    private function getStatusString(): string
    {
        if ($this->calculator->getFakePercentage() > 50) {
            return 'fake';
        }

        if ($this->calculator->getInactivePercentage() > 50) {
            return 'inactive';
        }

        return 'good';
    }
}
