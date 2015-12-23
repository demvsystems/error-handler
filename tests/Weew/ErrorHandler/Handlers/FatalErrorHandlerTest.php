<?php

namespace Tests\Weew\ErrorHandler\Handlers;

use PHPUnit_Framework_TestCase;
use Weew\ErrorHandler\Errors\FatalError;
use Weew\ErrorHandler\Errors\IFatalError;
use Weew\ErrorHandler\Handlers\FatalErrorHandler;

class FatalErrorHandlerTest extends PHPUnit_Framework_TestCase {
    public function test_get_handler() {
        $callable = function(IFatalError $error) {};
        $handler = new FatalErrorHandler($callable);
        $this->assertTrue($callable === $handler->getHandler());
    }

    public function test_handle() {
        $handler = new FatalErrorHandler(function(IFatalError $error) {});
        $this->assertTrue(
            $handler->handle(new FatalError(null, null, null, null))
        );

        $handler = new FatalErrorHandler(function(IFatalError $error) {
            return true;
        });
        $this->assertTrue(
            $handler->handle(new FatalError(null, null, null, null))
        );

        $handler = new FatalErrorHandler(function(IFatalError $error) {
            return false;
        });
        $this->assertFalse(
            $handler->handle(new FatalError(null, null, null, null))
        );
    }
}
