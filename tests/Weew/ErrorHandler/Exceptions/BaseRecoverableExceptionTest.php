<?php

namespace Tests\Weew\ErrorHandler\Exceptions;

use PHPUnit_Framework_TestCase;
use Weew\ErrorHandler\Exceptions\NoticeException;

class BaseRecoverableExceptionTest extends PHPUnit_Framework_TestCase {
    public function test_getters() {
        $ex = new NoticeException('foo', 'bar', 'yolo', 'swag');
        $this->assertEquals('foo', $ex->getErrorNumber());
        $this->assertEquals('bar', $ex->getErrorString());
        $this->assertEquals('yolo', $ex->getErrorFile());
        $this->assertEquals('swag', $ex->getErrorLine());
    }

    public function test_is_recoverable() {
        $ex = new NoticeException('foo', 'bar', 'yolo', 'swag');
        $this->assertTrue($ex->isRecoverable());
    }
}
