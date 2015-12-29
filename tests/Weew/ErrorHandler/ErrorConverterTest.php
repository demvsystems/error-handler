<?php

namespace Tests\Weew\ErrorHandler;

use PHPUnit_Framework_TestCase;
use Tests\Weew\ErrorHandler\Stubs\FakeErrorConverter;
use Weew\ErrorHandler\ErrorConverter;
use Weew\ErrorHandler\ErrorHandler;
use Weew\ErrorHandler\Errors\RecoverableError;
use Weew\ErrorHandler\ErrorTypes;
use Weew\ErrorHandler\Exceptions\ErrorException;
use Weew\ErrorHandler\Exceptions\ParseException;

class ErrorConverterTest extends PHPUnit_Framework_TestCase {
    public function test_create_recoverable_error_and_call_handler() {
        $converter = new ErrorConverter();
        $handler = new ErrorHandler(true);
        $this->setExpectedException(ErrorException::class);
        $converter->createRecoverableErrorAndCallHandler(
            $handler, ErrorTypes::ERROR, 'foo', 'bar', 'yolo'
        );
    }

    public function test_extract_fatal_error_and_call_handler() {
        $converter = new ErrorConverter();
        $handler = new ErrorHandler(true);
        $this->assertNull(
            $converter->extractFatalErrorAndCallHandler($handler)
        );
    }

    public function test_extract_fatal_error_and_call_handler_with_fake_error() {
        $converter = new FakeErrorConverter();
        $handler = new ErrorHandler(true);
        $this->setExpectedException(ParseException::class);

        ob_start();
        $converter->extractFatalErrorAndCallHandler($handler);
    }
    
    public function test_convert_error_to_exception_and_call_handler() {
        $converter = new ErrorConverter();
        $handler = new ErrorHandler(true);
        $error = new RecoverableError(
            ErrorTypes::ERROR, 'foo', 'bar', 'yolo'
        );

        $this->setExpectedException(ErrorException::class);
        $converter->convertErrorToExceptionAndCallHandler($handler, $error);
    }

    public function test_convert_error_to_exception_and_call_handler_and_handle_exception() {
        $converter = new ErrorConverter();
        $handler = new ErrorHandler(true);
        $handler->addExceptionHandler(function(ErrorException $ex) {});
        $error = new RecoverableError(
            ErrorTypes::ERROR, 'foo', 'bar', 'yolo'
        );

        $converter->convertErrorToExceptionAndCallHandler($handler, $error);
    }
}
