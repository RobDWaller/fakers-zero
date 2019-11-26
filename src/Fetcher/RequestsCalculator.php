<?php

declare(strict_types=1);

namespace App\Fetcher;

class RequestsCalculator
{
    private $division;

    private $maxRequests;

    public function __construct(int $division, int $maxRequests)
    {
        if ($division === 0) {
            throw new \Exception('Cannot divide by zero, provide a division greater than zero.');
        }

        $this->division = $division;

        $this->maxRequests = $maxRequests;
    }

    public function calculate(int $followers): int
    {
        if ($followers === 0) {
            return 0;
        }

        if ($followers < $this->division) {
            return 1;
        }

        $result = (int) floor($followers / $this->division);

        return $result > $this->maxRequests ? $this->maxRequests : $result;
    }
}