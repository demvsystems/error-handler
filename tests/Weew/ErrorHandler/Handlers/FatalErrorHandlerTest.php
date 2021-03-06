<?php

namespace Tests\Weew\ErrorHandler\Handlers;

use PHPUnit\Framework\TestCase;
use Weew\ErrorHandler\Errors\FatalError;
use Weew\ErrorHandler\Errors\IError;
use Weew\ErrorHandler\Handlers\NativeErrorHandler;

class FatalErrorHandlerTest extends TestCase
{
    public function test_enable_and_disable_handler()
    {
        $callable = function (IError $error) {
        };
        $handler  = new NativeErrorHandler($callable);

        $this->assertTrue($handler->isEnabled());
        $handler->setEnabled(false);
        $this->assertFalse($handler->isEnabled());
    }

    public function test_get_handler()
    {
        $callable = function (IError $error) {
        };
        $handler  = new NativeErrorHandler($callable);
        $this->assertTrue($callable === $handler->getHandler());
    }

    public function test_handle()
    {
        $handler = new NativeErrorHandler(function (IError $error) {
        });
        $this->assertFalse(
            $handler->handle(new FatalError(null, null, null, null))
        );

        $handler = new NativeErrorHandler(function (IError $error) {
            return true;
        });
        $this->assertTrue(
            $handler->handle(new FatalError(null, null, null, null))
        );

        $handler = new NativeErrorHandler(function (IError $error) {
            return false;
        });
        $this->assertFalse(
            $handler->handle(new FatalError(null, null, null, null))
        );
    }
}
