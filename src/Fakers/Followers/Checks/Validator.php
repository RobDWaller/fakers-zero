<?php

declare(strict_types=1);

namespace App\Fakers\Followers\Checks;

use App\Fakers\Followers\Checks\Checks;
use App\Fakers\Followers\Checks\Callbacks;
use App\TwitterMapper\Object\User;

class Validator
{
    private const ANSWER_TYPES = [
        'fake',
        'good',
        'inactive'
    ];

    private $checks;

    private $callbacks;

    public function __construct(Checks $checks, Callbacks $callbacks)
    {
        $this->checks = $checks;

        $this->callbacks = $callbacks;
    }

    public function validate(): bool
    {
        foreach ($this->checks->getChecks() as $check) {
            if (!$this->validateCheck($check)) {
                throw new \Exception('Invalid fakers checks config. ' .
                    'Properties: [' . $check['answerType'] . ' ' . $check['question'] . ' ' . $check['callback'] . ']');
            }
        }
        
        return true;
    }

    private function validateCheck(array $check): bool
    {
        return $this->keysExist($check)
            && $this->validQuestion('get' . $check['question'])
            && in_array($check['answerType'], self::ANSWER_TYPES)
            && array_key_exists($check['callback'], $this->callbacks->getCallbacks());
    }

    private function keysExist(array $check): bool
    {
        return isset(
            $check['answerType'],
            $check['question'],
            $check['comparison'],
            $check['possibleScore'],
            $check['callback']
        );
    }

    private function validQuestion(string $question): bool
    {
        return method_exists(User::class, $question);
    }
}
