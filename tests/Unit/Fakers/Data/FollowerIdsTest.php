<?php

namespace Tests\Unit\Fakers\Data;

use PHPUnit\Framework\TestCase;
use App\Fakers\Data\FollowerIds;
use ReflectionMethod;

class FollowerIdsTest extends TestCase
{
    public function testFollowerIds()
    {
        $ids = new FollowerIds(5);

        $this->assertInstanceOf(FollowerIds::class, $ids);
    }

    public function testGroup()
    {
        $ids = new FollowerIds(2);

        $result = $ids->group($this->generateIds(2, 10));

        $this->assertCount(10, $result);
        $this->assertCount(2, $result[1]);
        $this->assertCount(2, $result[4]);
        $this->assertCount(2, $result[9]);
    }

    public function testGroupLarger()
    {
        $ids = new FollowerIds(5);

        $result = $ids->group($this->generateIds(20, 10));

        $this->assertCount(40, $result);
        $this->assertCount(5, $result[1]);
        $this->assertCount(5, $result[19]);
        $this->assertCount(5, $result[39]);
    }

    public function testGroupZero()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Cannot group ids by zero.');
        $ids = new FollowerIds(0);
    }

    public function testGroupErrors()
    {
        $ids = new FollowerIds(2);

        $idGroup1 = new \stdClass();
        $idGroup1->ids = [1, 2, 3, 4];
        $idGroup2 = new \stdClass();
        $idGroup2->errors = [true];
        $idGroup3 = new \stdClass();
        $idGroup3->ids = [1, 2, 3, 4];
        $idGroup4 = new \stdClass();
        $idGroup4->error = true;
        $idGroup5 = new \stdClass();
        $idGroup5->ids = [1, 2, 3, 4];
        $idGroup6 = new \stdClass();
        $idGroup6->ids = [];

        $followerIds = [
            $idGroup1,
            $idGroup2,
            $idGroup3,
            $idGroup4,
            $idGroup5,
            $idGroup6
        ];

        $result = $ids->group($followerIds);

        $this->assertCount(6, $result);
        $this->assertCount(2, $result[1]);
        $this->assertCount(2, $result[3]);
        $this->assertCount(2, $result[5]);
    }

    public function testHasIds()
    {
        $ids = new FollowerIds(2);

        $method = new ReflectionMethod(FollowerIds::class, 'hasIds');
        $method->setAccessible(true);

        $followerIds = new \stdClass();
        $followerIds->ids = [1, 2, 3, 4, 5];

        $result = $method->invokeArgs($ids, [$followerIds]);

        $this->assertTrue($result);
    }

    private function generateIds(int $groupCount, int $idCount): array
    {
        $groups = [];
        
        $g = 0;
        $i = 0;

        while ($g < $groupCount) {
            
            $ids = new \stdClass();
            $idsArray = [];
            
            while ($i < $idCount) {
                $idsArray[] = rand(1, 999);
                $i++;
            }

            $ids->ids = $idsArray;
            $groups[] = $ids;
            $i = 0;
            $idsArray = [];
            $g++;
        } 

        return $groups;
    }
}