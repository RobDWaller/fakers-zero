<?php

namespace Tests\Unit\Fakers\Followers\Answers;

use PHPUnit\Framework\TestCase;
use App\Fakers\Followers\Answers\Answer;
use App\Fakers\Followers\Answers\Collection as AnswersCollection;
use Doctrine\Common\Collections\ArrayCollection;

class AnswerCollectionTest extends TestCase
{
    public function testBuildCollection()
    {
        $answers = new AnswersCollection;

        $answer = new Answer('fake', 5, 6);

        $answers->addAnswer($answer);

        $result = $answers->getAnswers();

        $this->assertInstanceOf(ArrayCollection::class, $result);
    }

    public function testCheckAnswerResults()
    {
        $answers = new AnswersCollection;

        $answer = new Answer('fake', 4, 5);

        $answers->addAnswer($answer);

        $result = $answers->getAnswers();

        $this->assertEquals(1, $result->count());

        $this->assertEquals('fake', $result->first()->getType());
        $this->assertEquals(4, $result->first()->getActualScore());
        $this->assertEquals(5, $result->first()->getPossibleScore());
    }
}
