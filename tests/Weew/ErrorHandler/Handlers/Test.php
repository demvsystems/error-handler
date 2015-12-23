<?php

namespace Tests\Weew\ErrorHandler\Handlers;

use PHPUnit_Framework_TestCase;
use Weew\ErrorHandler\Handlers\RecoverableErrorHandler;

class RecoverableErrorHandlerTest extends PHPUnit_Framework_TestCase {
    public function test_get_handler() {
        $callable = function($number, $string, $file, $line) {};
        $handler = new RecoverableErrorHandler($callable);
        $this->assertTrue($callable === $handler->getHandler());
    }

    public function test_handle() {
        $handler = new RecoverableErrorHandler(function($number, $string, $file, $line) {});
        $this->assertTrue($handler->handle('foo', 'bar', 'yolo', 'swag'));

        $handler = new RecoverableErrorHandler(function($number, $string, $file, $line) {
            return true;
        });
        $this->assertTrue($handler->handle('foo', 'bar', 'yolo', 'swag'));

        $handler = new RecoverableErrorHandler(function($number, $string, $file, $line) {
            return false;
        });
        $this->assertFalse($handler->handle('foo', 'bar', 'yolo', 'swag'));
    }
}
