<?php

namespace Tests\Weew\ErrorHandler\Handlers;

use PHPUnit_Framework_TestCase;
use Weew\ErrorHandler\Handlers\FatalErrorHandler;

class FatalErrorHandlerTest extends PHPUnit_Framework_TestCase {
    public function test_get_handler() {
        $callable = function($type, $message, $file, $line) {};
        $handler = new FatalErrorHandler($callable);
        $this->assertTrue($callable === $handler->getHandler());
    }

    public function test_handle() {
        $handler = new FatalErrorHandler(function($type, $message, $file, $line) {});
        $this->assertTrue($handler->handle('foo', 'bar', 'yolo', 'swag'));

        $handler = new FatalErrorHandler(function($type, $message, $file, $line) {
            return true;
        });
        $this->assertTrue($handler->handle('foo', 'bar', 'yolo', 'swag'));

        $handler = new FatalErrorHandler(function($type, $message, $file, $line) {
            return false;
        });
        $this->assertFalse($handler->handle('foo', 'bar', 'yolo', 'swag'));
    }
}
