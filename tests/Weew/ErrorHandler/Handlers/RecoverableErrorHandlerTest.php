<?php

namespace Tests\Weew\ErrorHandler\Handlers;

use PHPUnit_Framework_TestCase;
use Weew\ErrorHandler\Errors\IError;
use Weew\ErrorHandler\Errors\RecoverableError;
use Weew\ErrorHandler\Handlers\RecoverableErrorHandler;

class RecoverableErrorHandlerTest extends PHPUnit_Framework_TestCase {
    public function test_get_handler() {
        $callable = function(IError $error) {};
        $handler = new RecoverableErrorHandler($callable);
        $this->assertTrue($callable === $handler->getHandler());
    }

    public function test_handle() {
        $handler = new RecoverableErrorHandler(function(IError $error) {});
        $this->assertTrue(
            $handler->handle(new RecoverableError(null, null, null, null))
        );

        $handler = new RecoverableErrorHandler(function(IError $error) {
            return true;
        });
        $this->assertTrue(
            $handler->handle(new RecoverableError(null, null, null, null))
        );

        $handler = new RecoverableErrorHandler(function(IError $error) {
            return false;
        });
        $this->assertFalse(
            $handler->handle(new RecoverableError(null, null, null, null))
        );
    }
}
