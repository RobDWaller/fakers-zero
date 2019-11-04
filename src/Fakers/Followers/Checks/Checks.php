<?php

declare(strict_types = 1);

namespace App\Fakers\Followers\Checks;

class Checks
{
    public function getChecks(): array
    {
        return [
            [
                'answerType' => 'fake',
                'question' => 'FollowerFollowsRatio',
                'comparison' => 20,
                'possibleScore' => 2,
                'callback' => '<'
            ]
        ];
    }
}