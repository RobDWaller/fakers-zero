<?php

namespace Tests\Unit\Fakers\Followers\Checks;

use PHPUnit\Framework\TestCase;
use App\Fakers\Followers\Checks\Checker;
use App\Fakers\Followers\Checks\Callbacks;
use App\Fakers\Followers\Checks\Checks;
use App\Fakers\Followers\Answers\Answer;
use App\TwitterMapper\Object\User;
use Doctrine\Common\Collections\ArrayCollection;
use ReflectionMethod;
use Mockery as m;

class CheckerTest extends TestCase
{
    public function testChecker()
    {
        $checks = new Checks();

        $callbacks = new Callbacks();

        $checker = new Checker($checks, $callbacks);

        $this->assertInstanceOf(Checker::class, $checker);
    }

    public function testCheck()
    {
        $checks = m::mock(Checks::class);
        $checks->shouldReceive('getChecks')
            ->twice()
            ->andReturn([[
                'answerType' => 'good',
                'question' => 'FollowersCount',
                'comparison' => 30,
                'possibleScore' => 3,
                'callback' => '>'
            ]]);

        $callbacks = new Callbacks();

        $checker = new Checker($checks, $callbacks);

        $user = m::mock(User::class);
        $user->shouldReceive('getFollowersCount')
            ->once()
            ->andReturn(2);

        $answers = $checker->check($user);

        $this->assertInstanceOf(ArrayCollection::class, $answers);
        $this->assertInstanceOf(Answer::class, $answers->first());
    }

    public function tearDown(): void
    {
        m::close();
    }
}
