<?php

namespace Tests\Weew\ErrorHandler;

use PHPUnit_Framework_TestCase;
use Weew\ErrorHandler\ErrorTypes;
use Weew\ErrorHandler\Exceptions\MissingExceptionForErrorType;
use Weew\ErrorHandler\Exceptions\ParseException;

class ErrorTypesTest extends PHPUnit_Framework_TestCase {
    public function test_get_recoverable_errors() {
        $errors = ErrorTypes::getRecoverableErrors();
        $this->assertTrue(is_array($errors));
        $this->assertTrue(count($errors) > 0);
    }

    public function test_get_fatal_errors() {
        $errors = ErrorTypes::getFatalErrors();
        $this->assertTrue(is_array($errors));
        $this->assertTrue(count($errors) > 0);
    }

    public function test_is_recoverable() {
        foreach (ErrorTypes::getFatalErrors() as $errorNumber) {
            $this->assertFalse(ErrorTypes::isRecoverable($errorNumber));
        }

        foreach (ErrorTypes::getRecoverableErrors() as $errorNumber) {
            $this->assertTrue(ErrorTypes::isRecoverable($errorNumber));
        }
    }

    public function test_is_fatal() {
        foreach (ErrorTypes::getRecoverableErrors() as $errorNumber) {
            $this->assertFalse(ErrorTypes::isFatal($errorNumber));
        }

        foreach (ErrorTypes::getFatalErrors() as $errorNumber) {
            $this->assertTrue(ErrorTypes::isFatal($errorNumber));
        }
    }

    public function test_get_error_types() {
        $types = ErrorTypes::getErrorTypes();
        $this->assertTrue(is_array($types));
        $this->assertTrue(count($types) > 0);
    }

    public function test_get_error_type_name() {
        $this->assertEquals('E_ERROR', ErrorTypes::getErrorTypeName(E_ERROR));
        $this->assertEquals('E_PARSE', ErrorTypes::getErrorTypeName(E_PARSE));
        $this->assertEquals('E_WARNING', ErrorTypes::getErrorTypeName(E_WARNING));
    }

    public function test_get_exception_classes_for_errors() {
        $this->assertTrue(is_array(ErrorTypes::getExceptionClassesForErrors()));
    }

    public function test_get_exception_classes_for_errors_exist() {
        foreach (ErrorTypes::getExceptionClassesForErrors() as $class) {
            $this->assertTrue(class_exists($class));
        }
    }

    public function test_get_exception_class_for_error() {
        $this->assertEquals(
            ParseException::class,
            ErrorTypes::getExceptionClassForError(ErrorTypes::PARSE)
        );
    }

    public function test_get_exception_class_for_error_missing() {
        $this->setExpectedException(MissingExceptionForErrorType::class, 'There is no custom exception for error of type "foo".');
        ErrorTypes::getExceptionClassForError('foo');
    }

    public function test_get_error_type_code() {
        $this->assertEquals(E_ERROR, ErrorTypes::getErrorTypeCode('E_ERROR'));
        $this->assertEquals(E_PARSE, ErrorTypes::getErrorTypeCode('E_PARSE'));
        $this->assertEquals(E_WARNING, ErrorTypes::getErrorTypeCode('E_WARNING'));
    }
}
