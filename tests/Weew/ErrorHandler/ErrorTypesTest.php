<?php

namespace Tests\Weew\ErrorHandler;

use PHPUnit_Framework_TestCase;
use Weew\ErrorHandler\ErrorTypes;

class ErrorTypesTest extends PHPUnit_Framework_TestCase {
    public function test_get_recoverable_errors() {
        $errors = ErrorTypes::getRecoverableErrors();
        $this->assertTrue(is_array($errors));
        $this->assertTrue(count($errors) > 0);
    }

    public function test_get_non_recoverable_errors() {
        $errors = ErrorTypes::getNonRecoverableErrors();
        $this->assertTrue(is_array($errors));
        $this->assertTrue(count($errors) > 0);
    }

    public function test_si_recoverable() {
        foreach (ErrorTypes::getRecoverableErrors() as $error) {
            $this->assertTrue(ErrorTypes::isRecoverable($error));
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
}
