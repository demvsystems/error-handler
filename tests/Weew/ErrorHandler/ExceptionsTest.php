<?php

namespace Tests\Weew\ErrorHandler;

use PHPUnit_Framework_TestCase;
use Tests\Weew\ErrorHandler\Helpers\TestRunner;

class ExceptionsTest extends PHPUnit_Framework_TestCase {
    public function test_exception_handled_in_cli_mode() {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('exception_handled.php');
        $this->assertStringEndsWith('handled exception', $result);
    }

    public function test_exception_unhandled_in_cli_mode() {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('exception_unhandled.php');
        $this->assertStringStartsWith("\nFatal error", $result);
    }

    public function test_exception_handled_in_http_mode() {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('exception_handled.php');
        $this->assertStringEndsWith('handled exception', $result);
    }

    public function test_exception_unhandled_in_http_mode() {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('exception_unhandled.php');
        $this->assertStringStartsWith("<br />\n<b>Fatal error</b>", $result);
    }
}
