<?php

namespace App\Fakers\Followers\Status;

use App\Fakers\Followers\Status\Status;
use Doctrine\Common\Collections\ArrayCollection;

class Collection
{
    private $statuses = [];

    public function getStatuses(): ArrayCollection
    {
        return new ArrayCollection($this->statuses);
    }

    public function addStatus(Status $status)
    {
        $this->statuses[] = $status;
    }
}
