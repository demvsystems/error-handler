<?php

namespace Tests\Weew\ErrorHandler;

use PHPUnit_Framework_TestCase;
use Weew\ErrorHandler\ErrorTypes;
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
        foreach (ErrorTypes::getFatalErrors() as $error) {
            $this->assertFalse(ErrorTypes::isRecoverable($error));
        }

        foreach (ErrorTypes::getRecoverableErrors() as $error) {
            $this->assertTrue(ErrorTypes::isRecoverable($error));
        }
    }

    public function test_is_fatal() {
        foreach (ErrorTypes::getRecoverableErrors() as $error) {
            $this->assertFalse(ErrorTypes::isFatal($error));
        }

        foreach (ErrorTypes::getFatalErrors() as $error) {
            $this->assertTrue(ErrorTypes::isFatal($error));
        }
    }

    public function test_get_error_types() {
        $types = ErrorTypes::getErrorTypes();
        $this->assertTrue(is_array($types));
        $this->assertTrue(count($types) > 0);
    }

    public function test_get_error_type() {
        $this->assertEquals('E_ERROR', ErrorTypes::getErrorType(E_ERROR));
        $this->assertEquals('E_PARSE', ErrorTypes::getErrorType(E_PARSE));
        $this->assertEquals('E_WARNING', ErrorTypes::getErrorType(E_WARNING));
    }

    public function test_get_exception_classes_for_errors() {
        $this->assertTrue(is_array(ErrorTypes::getExceptionClassesForErrors()));
    }

    public function test_exception_classes_for_errors_exist() {
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
}
