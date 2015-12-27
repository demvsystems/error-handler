<?php

namespace Tests\Weew\ErrorHandler;

use PHPUnit_Framework_TestCase;
use Tests\Weew\ErrorHandler\Helpers\TestRunner;

class RecoverableErrorsTest extends PHPUnit_Framework_TestCase {
    public function test_recoverable_handled_in_cli_mode() {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('recoverable_handled.php');
        $this->assertEquals('handled recoverable continue', $result);
    }

    public function test_recoverable_handled_converted_in_cli_mode() {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('recoverable_handled_converted.php');
        $this->assertEquals('handled recoverable converted continue', $result);
    }

    public function test_recoverable_handled_in_http_mode() {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('recoverable_handled.php');
        $this->assertEquals('handled recoverable continue', $result);
    }

    public function test_recoverable_handled_converted_in_http_mode() {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('recoverable_handled_converted.php');
        $this->assertEquals('handled recoverable converted continue', $result);
    }

    public function test_recoverable_unhandled_in_cli_mode() {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('recoverable_unhandled.php');
        $this->assertStringStartsWith("\nFatal error", $result);
    }

    public function test_recoverable_unhandled_converted_in_cli_mode() {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('recoverable_unhandled_converted.php');
        $this->assertStringStartsWith("\nFatal error", $result);
    }

    public function test_recoverable_unhandled_in_http_mode() {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('recoverable_unhandled.php');
        $this->assertTrue(strpos($result, "Fatal error") !== false);
    }

    public function test_recoverable_unhandled_converted_in_http_mode() {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('recoverable_unhandled_converted.php');
        $this->assertTrue(strpos($result, "Fatal error") !== false);
    }
}
