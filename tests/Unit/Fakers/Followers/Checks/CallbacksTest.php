<?php

namespace Tests\Unit\Fakers\Followers\Checks;

use PHPUnit\Framework\TestCase;
use App\Fakers\Followers\Checks\Callbacks;

class CallbacksTest extends TestCase
{
    public function testCallbacks()
    {
        $callbacks = new Callbacks();

        $this->assertInstanceOf(Callbacks::class, $callbacks);
    }

    public function testGetCallbacks()
    {
        $callbacks = new Callbacks();

        $callbacks = $callbacks->getCallbacks();

        $this->assertArrayHasKey('>', $callbacks);
        $this->assertArrayHasKey('>=', $callbacks);
        $this->assertArrayHasKey('<', $callbacks);
        $this->assertArrayHasKey('<=', $callbacks);
        $this->assertArrayHasKey('===', $callbacks);
        $this->assertArrayHasKey('empty', $callbacks);
    }

    public function testGreaterThan()
    {
        $callbacks = new Callbacks();

        $callbacks = $callbacks->getCallbacks();

        $this->assertTrue($callbacks['>'](2, 1));
        $this->assertFalse($callbacks['>'](1, 2));
        $this->assertFalse($callbacks['>'](2, 2));
        $this->assertTrue($callbacks['>='](2, 1));
        $this->assertTrue($callbacks['>='](1, 1));
        $this->assertFalse($callbacks['>='](1, 2));
    }

    public function testLessThan()
    {
        $callbacks = new Callbacks();

        $callbacks = $callbacks->getCallbacks();

        $this->assertTrue($callbacks['<'](1, 2));
        $this->assertFalse($callbacks['<'](2, 1));
        $this->assertFalse($callbacks['<'](2, 2));
        $this->assertTrue($callbacks['<='](1, 2));
        $this->assertTrue($callbacks['<='](1, 1));
        $this->assertFalse($callbacks['<='](2, 1));
    }

    public function testEqualTo()
    {
        $callbacks = new Callbacks();

        $callbacks = $callbacks->getCallbacks();

        $this->assertTrue($callbacks['==='](1, 1));
        $this->assertFalse($callbacks['==='](1, 2));
        $this->assertFalse($callbacks['==='](2, 1));
        $this->assertFalse($callbacks['==='](2, "2"));
    }

    public function testEmpty()
    {
        $callbacks = new Callbacks();

        $callbacks = $callbacks->getCallbacks();

        $this->assertTrue($callbacks['empty'](null));
        $this->assertTrue($callbacks['empty'](''));
        $this->assertFalse($callbacks['empty'](1));
        $this->assertFalse($callbacks['empty']("1"));
    }
}