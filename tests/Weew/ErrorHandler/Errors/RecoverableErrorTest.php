<?php

namespace Tests\Weew\ErrorHandler\Errors;

use PHPUnit_Framework_TestCase;
use Weew\ErrorHandler\Errors\RecoverableError;

class RecoverableErrorTest extends PHPUnit_Framework_TestCase {
    public function test_getters() {
        $error = new RecoverableError('foo', 'bar', 'yolo', 'swag');
        $this->assertEquals('foo', $error->getType());
        $this->assertEquals('bar', $error->getMessage());
        $this->assertEquals('yolo', $error->getFile());
        $this->assertEquals('swag', $error->getLine());
    }

    public function test_is_recoverable() {
        $error = new RecoverableError('foo', 'bar', 'yolo', 'swag');
        $this->assertTrue($error->isRecoverable());
    }
}
