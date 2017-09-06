<?php

namespace Tests\Weew\ErrorHandler\Exceptions;

use PHPUnit\Framework\TestCase;
use Weew\ErrorHandler\Exceptions\NoticeException;

class BaseRecoverableExceptionTest extends TestCase
{
    public function test_getters()
    {
        $ex = new NoticeException('foo', 'bar', 'yolo', 'swag');
        $this->assertEquals('foo', $ex->getErrorCode());
        $this->assertEquals('bar', $ex->getErrorMessage());
        $this->assertEquals('yolo', $ex->getErrorFile());
        $this->assertEquals('swag', $ex->getErrorLine());
    }

    public function test_is_recoverable()
    {
        $ex = new NoticeException('foo', 'bar', 'yolo', 'swag');
        $this->assertTrue($ex->isRecoverable());
    }
}
