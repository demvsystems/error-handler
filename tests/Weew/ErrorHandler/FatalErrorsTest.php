<?php

namespace Tests\Weew\ErrorHandler;

use PHPUnit\Framework\TestCase;
use Tests\Weew\ErrorHandler\Helpers\TestRunner;

class FatalErrorsTest extends TestCase
{
    public function test_fatal_handled_in_cli_mode()
    {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('fatal_handled.php');
        $this->assertStringEndsWith('handled fatal', $result);
    }

    public function test_fatal_handled_converted_in_cli_mode()
    {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('fatal_handled_converted.php');
        $this->assertStringEndsWith('handled fatal converted', $result);
    }

    public function test_fatal_handled_in_http_mode()
    {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('fatal_handled.php');
        $this->assertEquals('handled fatal', $result);
    }

    public function test_fatal_handled_converted_in_http_mode()
    {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('fatal_handled_converted.php');
        $this->assertEquals('handled fatal converted', $result);
    }

    public function test_fatal_unhandled_in_cli_mode()
    {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('fatal_unhandled.php');
        $this->assertStringStartsWith("\nFatal error", $result);
    }

    public function test_fatal_unhandled_converted_in_cli_mode()
    {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('fatal_unhandled_converted.php');
        $this->assertStringStartsWith("\nFatal error", $result);
    }

    public function test_fatal_unhandled_in_http_mode()
    {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('fatal_unhandled.php');
        $this->assertStringStartsWith("\nFatal error", $result);
    }

    public function test_fatal_unhandled_converted_in_http_mode()
    {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('fatal_unhandled_converted.php');
        $this->assertStringStartsWith("\nFatal error", $result);
    }
}
