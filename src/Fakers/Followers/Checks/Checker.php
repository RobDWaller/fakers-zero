<?php

declare(strict_types=1);

namespace App\Fakers\Followers\Checks;

use App\Fakers\Followers\Answers\Answer;
use App\Fakers\Followers\Checks\Callbacks;
use App\Fakers\Followers\Checks\Checks;
use App\TwitterMapper\Object\User;
use Doctrine\Common\Collections\ArrayCollection;

class Checker
{
    private $checks;

    private $callbacks;

    public function __construct(Checks $checks, Callbacks $callbacks)
    {
        $this->checks = $checks;

        $this->callbacks = $callbacks;
    }

    public function check(User $user): ArrayCollection
    {
        $validator = new Validator($this->checks, $this->callbacks);
        $validator->validate();

        $answers = [];

        foreach ($this->checks->getChecks() as $check) {
            $answers[] = $this->getAnswer($user, $check);
        }

        return new ArrayCollection($answers);
    }

    private function getAnswer(User $user, array $check): Answer
    {
        $callback = $this->callbacks->getCallbacks()[$check['callback']];

        return $callback($user->{'get' . $check['question']}(), $check['comparison']) ?
            new Answer($check['answerType'], $check['possibleScore'], $check['possibleScore']) :
            new Answer($check['answerType'], 0, $check['possibleScore']);
    }
}
