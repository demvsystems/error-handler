<?php

namespace Tests\Weew\ErrorHandler\Handlers;

use Exception;
use PHPUnit_Framework_TestCase;
use Tests\Weew\ErrorHandler\Stubs\FooException;
use Weew\ErrorHandler\Handlers\ExceptionHandler;

class ExceptionHandlerTest extends PHPUnit_Framework_TestCase {
    public function test_get_handler() {
        $callable = function(FooException $ex) {};
        $handler = new ExceptionHandler($callable);
        $this->assertTrue($callable === $handler->getHandler());
    }

    public function test_get_exception_class() {
        $handler = new ExceptionHandler(function(FooException $ex) {});
        $this->assertEquals(
            FooException::class, $handler->getExceptionClass()
        );

        $handler = new ExceptionHandler(function() {});
        $this->assertNull($handler->getExceptionClass());

        $handler = new ExceptionHandler(function($ex) {});
        $this->assertNull($handler->getExceptionClass());
    }

    public function test_supports() {
        $handler = new ExceptionHandler(function(FooException $ex) {});
        $this->assertTrue($handler->supports(new FooException()));
        $this->assertFalse($handler->supports(new Exception()));

        $handler = new ExceptionHandler(function(Exception $ex) {});
        $this->assertTrue($handler->supports(new Exception()));
        $this->assertTrue($handler->supports(new FooException()));

        $handler = new ExceptionHandler(function() {});
        $this->assertFalse($handler->supports(new Exception()));

        $handler = new ExceptionHandler(function($ex) {});
        $this->assertFalse($handler->supports(new Exception()));
    }

    public function test_handle() {
        $handler = new ExceptionHandler(function(FooException $ex) {});
        $this->assertTrue($handler->handle(new FooException()));
        $this->assertFalse($handler->handle(new Exception()));

        $handler = new ExceptionHandler(function(Exception $ex) {
            return true;
        });
        $this->assertTrue($handler->handle(new FooException()));
        $this->assertTrue($handler->handle(new Exception()));

        $handler = new ExceptionHandler(function(Exception $ex) {
            return false;
        });
        $this->assertFalse($handler->handle(new FooException()));
        $this->assertFalse($handler->handle(new Exception()));
    }
}
