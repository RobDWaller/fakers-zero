<?php

namespace Tests\Unit\Fakers\Followers\Answers;

use PHPUnit\Framework\TestCase;
use App\Fakers\Followers\Answers\Answer;

class AnswerTest extends TestCase
{
    public function testGetType()
    {
        $answer = new Answer('fake', 0, 1);

        $this->assertInstanceOf(Answer::class, $answer);

        $this->assertEquals('fake', $answer->getType());
    }

    public function testGetActualScore()
    {
        $answer = new Answer('fake', 0, 1);

        $this->assertEquals(0, $answer->getActualScore());
    }

    public function testGetPossibleScore()
    {
        $answer = new Answer('fake', 0, 1);

        $this->assertEquals(1, $answer->getPossibleScore());
    }
}
