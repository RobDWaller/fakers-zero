<?php

namespace Tests\Unit\Fakers\Followers\Checks;

use PHPUnit\Framework\TestCase;
use App\Fakers\Followers\Checks\Validator;
use App\Fakers\Followers\Checks\Checks;
use App\Fakers\Followers\Checks\Callbacks;
use Mockery as m;

class ValidatorTest extends TestCase
{
    public function testValidator()
    {
        $checks = new Checks();
        $callbacks = new Callbacks();

        $validator = new Validator($checks, $callbacks);

        $this->assertInstanceOf(Validator::class, $validator);
    }

    public function testValidate()
    {
        $checks = m::mock(Checks::class);
        $checks->shouldReceive('getChecks')
            ->once()
            ->andReturn([[
                'answerType' => 'fake',
                'question' => 'FollowerFollowsRatio',
                'comparison' => 20,
                'possibleScore' => 2,
                'callback' => '<'
            ]]);
        
        $callbacks = m::mock(Callbacks::class);
        $callbacks->shouldReceive('getCallbacks')
            ->once()
            ->andReturn(['<' => '']);

        $validator = new Validator($checks, $callbacks);

        $this->assertTrue($validator->validate());
    }
}
