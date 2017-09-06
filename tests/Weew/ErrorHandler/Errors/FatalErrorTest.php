<?php

namespace Tests\Weew\ErrorHandler\Errors;

use PHPUnit\Framework\TestCase;
use Weew\ErrorHandler\Errors\FatalError;

class FatalErrorTest extends TestCase
{
    public function test_getters()
    {
        $error = new FatalError('foo', 'bar', 'yolo', 'swag');
        $this->assertEquals('foo', $error->getCode());
        $this->assertEquals('bar', $error->getMessage());
        $this->assertEquals('yolo', $error->getFile());
        $this->assertEquals('swag', $error->getLine());
    }

    public function test_is_recoverable()
    {
        $error = new FatalError('foo', 'bar', 'yolo', 'swag');
        $this->assertFalse($error->isRecoverable());
    }
}
