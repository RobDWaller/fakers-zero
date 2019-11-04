<?php

namespace Tests\Unit\Fakers\Followers\Checks;

use App\Fakers\Followers\Checks\Checks;
use PHPUnit\Framework\TestCase;

class ChecksTest extends TestCase
{
    public function testChecks()
    {
        $checks = new Checks();

        $this->assertInstanceOf(Checks::class, $checks);
    }

    public function testGetChecks()
    {
        $checks = new Checks();

        $this->assertCount(23, $checks->getChecks());
    }

    public function testChecksRow()
    {
        $checks = new Checks();

        $checks = $checks->getChecks();

        $this->assertArrayHasKey('answerType', $checks[0]);
        $this->assertArrayHasKey('question', $checks[0]);
        $this->assertArrayHasKey('comparison', $checks[0]);
        $this->assertArrayHasKey('possibleScore', $checks[0]);
        $this->assertArrayHasKey('callback', $checks[0]);
    }
}