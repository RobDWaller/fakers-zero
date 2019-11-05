<?php

declare(strict_types=1);

namespace App\Fakers\Followers\Checks;

class Callbacks
{
    public function getCallbacks()
    {
        return [
            '>' => function ($a, $b) {
                return $a > $b;
            },
            '>=' => function ($a, $b) {
                return $a >= $b;
            },
            '<' => function ($a, $b) {
                return $a < $b;
            },
            '<=' => function ($a, $b) {
                return $a <= $b;
            },
            '===' => function ($a, $b) {
                return $a === $b;
            },
            'empty' => function ($a) {
                return empty($a);
            },
        ];
    }
}
