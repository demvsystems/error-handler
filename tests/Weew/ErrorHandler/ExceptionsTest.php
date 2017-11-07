<?php

namespace Tests\Weew\ErrorHandler;

use PHPUnit\Framework\TestCase;
use Tests\Weew\ErrorHandler\Helpers\TestRunner;

class ExceptionsTest extends TestCase
{
    public function test_exception_handled_in_cli_mode()
    {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('exception_handled.php');
        $this->assertStringEndsWith('handled exception', $result);
    }

    public function test_exception_unhandled_in_cli_mode()
    {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('exception_unhandled.php');
        $this->assertStringStartsWith("\nFatal error", $result);
    }

    public function test_exception_handled_in_http_mode()
    {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('exception_handled.php');
        $this->assertStringEndsWith('handled exception', $result);
    }

    public function test_exception_unhandled_in_http_mode()
    {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('exception_unhandled.php');
        $this->assertTrue(strpos($result, "Fatal error") !== false);
    }
}
