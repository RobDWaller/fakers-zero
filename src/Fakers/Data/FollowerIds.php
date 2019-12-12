<?php

declare(strict_types=1);

namespace App\Fakers\Data;

class FollowerIds
{
    private $groupLimit;

    public function __construct(int $groupLimit)
    {
        if ($groupLimit === 0) {
            throw new \Exception('Cannot group ids by zero.');
        }

        $this->groupLimit = $groupLimit;
    }

    public function group(array $ids): array
    {
        $groups = [];
        $groupCount = 0;
        $idCount = 1;

        foreach ($ids as $idGroup) {
            if ($this->hasIds($idGroup)) {
                $reduce = $this->reduceIds($idGroup, $groups, $groupCount, $idCount);
                
                $groups = $reduce['groups'];
                $groupCount = $reduce['groupCount'];
                $idCount = $reduce['idCount'];
            }
        }
        
        return $groups;
    }

    private function reduceIds(object $idGroup, array $groups, int $groupCount, int $idCount): array
    {
        $initial = ['groups' => $groups, 'groupCount' => $groupCount, 'idCount' => $idCount];

        return array_reduce($idGroup->ids, function ($carry, $item) {
            $carry['groups'][$carry['groupCount']][] = $item;
                    
            if ($carry['idCount'] === $this->groupLimit) {
                $carry['idCount'] = 1;
                $carry['groupCount']++;
            } else {
                $carry['idCount']++;
            }

            return $carry;
        }, $initial);
    }

    private function hasIds(object $idGroup): bool
    {
        return !isset($idGroup->errors) && !isset($idGroup->error) && !empty($idGroup->ids);
    }
}
