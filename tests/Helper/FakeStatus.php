<?php

namespace Tests\Helper;

use Faker\Factory;
use App\Faker\Follower\Status\Status;

class FakeStatus
{
    public function getStatus(): Status
    {
        $faker = Factory::create();

        $status = new Status(
            $faker->randomElement(['fake', 'inactive', 'good']),
            $faker->randomFloat(2, 0, 100),
            $faker->randomFloat(2, 0, 100),
            $faker->randomFloat(2, 0, 100)
        );

        return $status;
    }

    public function getStatuses(int $count): array
    {
        $i = 0;

        $statuses = [];

        while ($i < $count) {
            $statuses[] = $this->getStatus();

            $i++;
        }

        return $statuses;
    }
}
