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
        $groupCounter = 0;
        $idCounter = 1;

        foreach ($ids as $idGroup) {
            
            if ($this->hasIds($idGroup)) {
				
				foreach ($idGroup->ids as $id) {
					$groups[$groupCounter][] = $id; 
					
					if ($idCounter === $this->groupLimit) {
                        $idCounter = 1;
                        $groupCounter++;
					}
					else {
						$idCounter++;
					}
				}
				
			}
        }
        
        return $groups;
    }

    private function hasIds(Object $idGroup): bool
    {
        return !isset($idGroup->errors)&&!isset($idGroup->error)&&!empty($idGroup->ids);
    }
}