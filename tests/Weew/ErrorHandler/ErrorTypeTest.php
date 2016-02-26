<?php

namespace Tests\Weew\ErrorHandler;

use PHPUnit_Framework_TestCase;
use Weew\ErrorHandler\ErrorType;
use Weew\ErrorHandler\Exceptions\MissingExceptionForErrorType;
use Weew\ErrorHandler\Exceptions\ParseException;

class ErrorTypeTest extends PHPUnit_Framework_TestCase {
    public function test_get_recoverable_errors() {
        $errors = ErrorType::getRecoverableErrors();
        $this->assertTrue(is_array($errors));
        $this->assertTrue(count($errors) > 0);
    }

    public function test_get_fatal_errors() {
        $errors = ErrorType::getFatalErrors();
        $this->assertTrue(is_array($errors));
        $this->assertTrue(count($errors) > 0);
    }

    public function test_is_recoverable() {
        foreach (ErrorType::getFatalErrors() as $errorNumber) {
            $this->assertFalse(ErrorType::isRecoverable($errorNumber));
        }

        foreach (ErrorType::getRecoverableErrors() as $errorNumber) {
            $this->assertTrue(ErrorType::isRecoverable($errorNumber));
        }
    }

    public function test_is_fatal() {
        foreach (ErrorType::getRecoverableErrors() as $errorNumber) {
            $this->assertFalse(ErrorType::isFatal($errorNumber));
        }

        foreach (ErrorType::getFatalErrors() as $errorNumber) {
            $this->assertTrue(ErrorType::isFatal($errorNumber));
        }
    }

    public function test_get_error_types() {
        $types = ErrorType::getErrorTypes();
        $this->assertTrue(is_array($types));
        $this->assertTrue(count($types) > 0);
    }

    public function test_get_error_type_name() {
        $this->assertEquals('E_ERROR', ErrorType::getErrorTypeName(E_ERROR));
        $this->assertEquals('E_PARSE', ErrorType::getErrorTypeName(E_PARSE));
        $this->assertEquals('E_WARNING', ErrorType::getErrorTypeName(E_WARNING));
    }

    public function test_get_exception_classes_for_errors() {
        $this->assertTrue(is_array(ErrorType::getExceptionClassesForErrors()));
    }

    public function test_get_exception_classes_for_errors_exist() {
        foreach (ErrorType::getExceptionClassesForErrors() as $class) {
            $this->assertTrue(class_exists($class));
        }
    }

    public function test_get_exception_class_for_error() {
        $this->assertEquals(
            ParseException::class,
            ErrorType::getExceptionClassForError(ErrorType::PARSE)
        );
    }

    public function test_get_exception_class_for_error_missing() {
        $this->setExpectedException(MissingExceptionForErrorType::class, 'There is no custom exception for error of type "foo".');
        ErrorType::getExceptionClassForError('foo');
    }

    public function test_get_error_type_code() {
        $this->assertEquals(E_ERROR, ErrorType::getErrorTypeCode('E_ERROR'));
        $this->assertEquals(E_PARSE, ErrorType::getErrorTypeCode('E_PARSE'));
        $this->assertEquals(E_WARNING, ErrorType::getErrorTypeCode('E_WARNING'));
    }
}
