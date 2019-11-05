<?php

declare(strict_types=1);

namespace App\Fakers\Followers\Checks;

class Callbacks
{
    public function getCallbacks()
    {
        return [
            '>' => function ($input, $comparison) {
                return $input > $comparison;
            },
            '>=' => function ($input, $comparison) {
                return $input >= $comparison;
            },
            '<' => function ($input, $comparison) {
                return $input < $comparison;
            },
            '<=' => function ($input, $comparison) {
                return $input <= $comparison;
            },
            '===' => function ($input, $comparison) {
                return $input === $comparison;
            },
            'empty' => function ($input) {
                return empty($input);
            },
        ];
    }
}
