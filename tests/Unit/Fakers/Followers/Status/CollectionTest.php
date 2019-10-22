<?php

namespace Tests\Unit\Fakers\Followers\Status;

use PHPUnit\Framework\TestCase;
use App\Fakers\Followers\Status\Status;
use App\Fakers\Followers\Status\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Tests\Helper\FakeStatus;

class CollectionTest extends TestCase
{
    public function testBuildStatusCollection()
    {
        $statusCollection = new Collection;

        $fakeStatus = new FakeStatus;

        $statuses = $fakeStatus->getStatuses(20);

        foreach ($statuses as $status) {
            $statusCollection->addStatus($status);
        }

        $this->assertInstanceOf(ArrayCollection::class, $statusCollection->getStatuses());

        $this->assertInstanceOf(Status::class, $statusCollection->getStatuses()->first());
    }
}
