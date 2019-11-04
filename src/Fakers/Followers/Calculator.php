<?php

namespace App\Fakers\Followers;

use Doctrine\Common\Collections\ArrayCollection;

class Calculator
{
    private $answers;

    public function __construct(ArrayCollection $answers)
    {
        $this->answers = $answers;
    }

    public function getGoodPercentage(): float
    {
        $answers = $this->filterAnswers('good');

        $result = $this->filterCountTotal($answers);

        return $this->calculatePercentage($result['count'], $result['total']);
    }

    public function getInactivePercentage(): float
    {
        $answers = $this->filterAnswers('inactive');

        $result = $this->filterCountTotal($answers);

        return $this->calculatePercentage($result['count'], $result['total']);
    }

    public function getFakePercentage(): float
    {
        $answers = $this->filterAnswers('fake');

        $result = $this->filterCountTotal($answers);

        return $this->calculatePercentage($result['count'], $result['total']);
    }

    private function filterAnswers(string $filter)
    {
        return $this->answers->filter(function ($answer) use ($filter) {
            return $answer->getType() === $filter;
        });
    }

    private function filterCountTotal(ArrayCollection $filteredAnswers): array
    {
        $result['count'] = 0;
        $result['total'] = 0;

        foreach ($filteredAnswers as $answer) {
            $result['count'] += $answer->getActualScore();
            $result['total'] += $answer->getPossibleScore();
        }

        return $result;
    }

    private function calculatePercentage(int $count, int $total): float
    {
        return $total > 0 ? round(($count / $total) * 100, 2) : 0;
    }
}
