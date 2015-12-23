<?php

namespace Tests\Weew\ErrorHandler;

use PHPUnit_Framework_TestCase;
use Tests\Weew\ErrorHandler\Stubs\BarException;
use Tests\Weew\ErrorHandler\Stubs\FooException;
use Weew\ErrorHandler\ErrorHandler;

class ErrorHandlerTest extends PHPUnit_Framework_TestCase {
    private function getNoop() {
        return function() {};
    }

    public function test_enable_exception_handling() {
        $handler = new ErrorHandler();
        $this->assertFalse($handler->isExceptionHandlingEnabled());
        $handler->enableExceptionHandling();
        $this->assertTrue($handler->isExceptionHandlingEnabled());
        $handler->enableExceptionHandling();
        $this->assertTrue($handler->isExceptionHandlingEnabled());
    }

    public function test_enable_recoverable_error_handling() {
        $handler = new ErrorHandler();
        $this->assertFalse($handler->isRecoverableErrorHandlingEnabled());
        $handler->enableRecoverableErrorHandling();
        $this->assertTrue($handler->isRecoverableErrorHandlingEnabled());
        $handler->enableRecoverableErrorHandling();
        $this->assertTrue($handler->isRecoverableErrorHandlingEnabled());
    }

    public function test_enable_fatal_error_handling() {
        $handler = new ErrorHandler();
        $this->assertFalse($handler->isFatalErrorHandlingEnabled());
        $handler->enableFatalErrorHandling();
        $this->assertTrue($handler->isFatalErrorHandlingEnabled());
        $handler->enableFatalErrorHandling();
        $this->assertTrue($handler->isFatalErrorHandlingEnabled());
    }

    public function test_enable() {
        $handler = new ErrorHandler();
        $this->assertFalse($handler->isExceptionHandlingEnabled());
        $this->assertFalse($handler->isRecoverableErrorHandlingEnabled());
        $this->assertFalse($handler->isFatalErrorHandlingEnabled());
        $handler->enable();
        $this->assertTrue($handler->isExceptionHandlingEnabled());
        $this->assertTrue($handler->isRecoverableErrorHandlingEnabled());
        $this->assertTrue($handler->isFatalErrorHandlingEnabled());
    }

    public function test_add_and_get_exception_handlers() {
        $handler = new ErrorHandler();
        $this->assertEquals(0, count($handler->getExceptionHandlers()));
        $handler->addExceptionHandler($this->getNoop());
        $this->assertEquals(1, count($handler->getExceptionHandlers()));
    }

    public function test_add_and_get_recoverable_error_handlers() {
        $handler = new ErrorHandler();
        $this->assertEquals(0, count($handler->getRecoverableErrorHandlers()));
        $handler->addRecoverableErrorHandler($this->getNoop());
        $this->assertEquals(1, count($handler->getRecoverableErrorHandlers()));
    }

    public function test_add_and_get_fatal_error_handlers() {
        $handler = new ErrorHandler();
        $this->assertEquals(0, count($handler->getFatalErrorHandlers()));
        $handler->addFatalErrorHandler($this->getNoop());
        $this->assertEquals(1, count($handler->getFatalErrorHandlers()));
    }

    public function test_handle_exception_without_handler() {
        $handler = new ErrorHandler();
        $this->setExpectedException(FooException::class);
        $handler->handleException(new FooException());
    }

    public function test_handle_exception_with_handler() {
        $handler = new ErrorHandler();
        $handler->addExceptionHandler(function(FooException $ex) {});
        $handler->handleException(new FooException());
    }

    public function test_handle_exception_with_negative_handler() {
        $handler = new ErrorHandler();
        $handler->addExceptionHandler(function(FooException $ex) {
            return false;
        });
        $this->setExpectedException(FooException::class);
        $handler->handleException(new FooException());
    }

    public function test_handle_exception_with_unsupported_handler() {
        $handler = new ErrorHandler();
        $handler->addExceptionHandler(function(BarException $ex) {});
        $this->setExpectedException(FooException::class);
        $handler->handleException(new FooException());
    }

    public function test_handle_recoverable_error_without_handler() {
        $handler = new ErrorHandler();
        $this->assertFalse(
            $handler->handleRecoverableError('foo', 'bar', 'yolo', 'swag')
        );
    }

    public function test_handle_recoverable_error_with_handler() {
        $handler = new ErrorHandler();
        $handler->addRecoverableErrorHandler(function() {});
        $this->assertNull(
            $handler->handleRecoverableError('foo', 'bar', 'yolo', 'swag')
        );
    }

    public function test_handle_recoverable_error_with_negative_handler() {
        $handler = new ErrorHandler();
        $handler->addRecoverableErrorHandler(function() {
            return false;
        });
        $this->assertFalse(
            $handler->handleRecoverableError('foo', 'bar', 'yolo', 'swag')
        );
    }

    public function test_handle_fatal_error_without_handler() {
        ob_start();
        $handler = new ErrorHandler();
        $handler->handleFatalError('foo', 'bar', 'yolo', 'swag');
    }

    public function test_handle_fatal_error_with_handler() {
        ob_start();
        $handler = new ErrorHandler();
        $handler->addFatalErrorHandler(function() {});
        $this->assertNull(
            $handler->handleFatalError('foo', 'bar', 'yolo', 'swag')
        );
    }

    public function test_handle_fatal_error_with_negative_handler() {
        ob_start();
        $handler = new ErrorHandler();
        $handler->addFatalErrorHandler(function() {
            return false;
        });
        $this->assertFalse(
            $handler->handleFatalError('foo', 'bar', 'yolo', 'swag')
        );
    }

    public function test_() {

    }
}
