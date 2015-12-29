<?php

namespace Tests\Weew\ErrorHandler;

use PHPUnit_Framework_TestCase;
use Tests\Weew\ErrorHandler\Stubs\BarException;
use Tests\Weew\ErrorHandler\Stubs\FakeExceptionHandler;
use Tests\Weew\ErrorHandler\Stubs\FakeFatalErrorHandler;
use Tests\Weew\ErrorHandler\Stubs\FakeRecoverableErrorHandler;
use Tests\Weew\ErrorHandler\Stubs\FooException;
use Weew\ErrorHandler\ErrorHandler;
use Weew\ErrorHandler\Errors\FatalError;
use Weew\ErrorHandler\Errors\RecoverableError;
use Weew\ErrorHandler\ErrorTypes;
use Weew\ErrorHandler\Exceptions\ErrorException;
use Weew\ErrorHandler\Exceptions\InvalidHandlerType;
use Weew\ErrorHandler\Exceptions\ParseException;

class ErrorHandlerTest extends PHPUnit_Framework_TestCase {
    private function getNoop() {
        return function() {};
    }

    public function test_convert_errors_to_exceptions() {
        $handler = new ErrorHandler(true);
        $this->assertTrue($handler->isConvertingErrorsToExceptions());
        $handler->convertErrorsToExceptions(false);
        $this->assertFalse($handler->isConvertingErrorsToExceptions());
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

    public function test_add_exception_handler_implementation() {
        $handler = new ErrorHandler();
        $this->assertEquals(0, count($handler->getExceptionHandlers()));
        $handler->addExceptionHandler(new FakeExceptionHandler());
        $this->assertEquals(1, count($handler->getExceptionHandlers()));
    }

    public function test_add_invalid_exception_handler() {
        $handler = new ErrorHandler();
        $this->setExpectedException(InvalidHandlerType::class);
        $handler->addExceptionHandler('foo');
    }

    public function test_add_and_get_recoverable_error_handlers() {
        $handler = new ErrorHandler();
        $this->assertEquals(0, count($handler->getRecoverableErrorHandlers()));
        $handler->addRecoverableErrorHandler($this->getNoop());
        $this->assertEquals(1, count($handler->getRecoverableErrorHandlers()));
    }

    public function test_add_recoverable_error_handler_implementation() {
        $handler = new ErrorHandler();
        $this->assertEquals(0, count($handler->getRecoverableErrorHandlers()));
        $handler->addRecoverableErrorHandler(new FakeRecoverableErrorHandler());
        $this->assertEquals(1, count($handler->getRecoverableErrorHandlers()));
    }

    public function test_add_invalid_recoverable_error_handler() {
        $handler = new ErrorHandler();
        $this->setExpectedException(InvalidHandlerType::class);
        $handler->addRecoverableErrorHandler('foo');
    }

    public function test_add_and_get_fatal_error_handlers() {
        $handler = new ErrorHandler();
        $this->assertEquals(0, count($handler->getFatalErrorHandlers()));
        $handler->addFatalErrorHandler($this->getNoop());
        $this->assertEquals(1, count($handler->getFatalErrorHandlers()));
    }

    public function test_add_fatal_error_handler_implementation() {
        $handler = new ErrorHandler();
        $this->assertEquals(0, count($handler->getFatalErrorHandlers()));
        $handler->addFatalErrorHandler(new FakeFatalErrorHandler());
        $this->assertEquals(1, count($handler->getFatalErrorHandlers()));
    }

    public function test_add_invalid_fatal_error_handler() {
        $handler = new ErrorHandler();
        $this->setExpectedException(InvalidHandlerType::class);
        $handler->addFatalErrorHandler('foo');
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
            $handler->handleRecoverableError(new RecoverableError(null, null, null, null))
        );
    }

    public function test_handle_recoverable_error_with_handler() {
        $handler = new ErrorHandler();
        $handler->addRecoverableErrorHandler(function() {});
        $this->assertNull(
            $handler->handleRecoverableError(new RecoverableError(null, null, null, null))
        );
    }

    public function test_handle_recoverable_error_with_negative_handler() {
        $handler = new ErrorHandler();
        $handler->addRecoverableErrorHandler(function() {
            return false;
        });
        $this->assertFalse(
            $handler->handleRecoverableError(new RecoverableError(null, null, null, null))
        );
    }

    public function test_handle_fatal_error_without_handler() {
        $handler = new ErrorHandler();

        ob_start();
        $handler->handleFatalError(new FatalError(null, null, null, null));
    }

    public function test_handle_fatal_error_with_handler() {
        $handler = new ErrorHandler();
        $handler->addFatalErrorHandler(function() {});

        ob_start();
        $this->assertNull(
            $handler->handleFatalError(new FatalError(null, null, null, null))
        );
    }

    public function test_handle_fatal_error_with_negative_handler() {
        $handler = new ErrorHandler();
        $handler->addFatalErrorHandler(function() {
            return false;
        });

        ob_start();
        $this->assertFalse(
            $handler->handleFatalError(new FatalError(null, null, null, null))
        );
    }

    public function test_handle_recoverable_error_with_error_to_exception_conversion_enabled() {
        $handler = new ErrorHandler(true);
        $this->setExpectedException(ErrorException::class);
        $handler->handleRecoverableError(
            new RecoverableError(ErrorTypes::ERROR, 'bar', 'baz', 'yolo')
        );
    }

    public function test_handle_fatal_error_with_error_to_exception_conversion_enabled() {
        $handler = new ErrorHandler(true);
        $this->setExpectedException(ParseException::class);

        ob_start();
        $handler->handleFatalError(
            new FatalError(ErrorTypes::PARSE, 'bar', 'baz', 'yolo')
        );
    }
}
