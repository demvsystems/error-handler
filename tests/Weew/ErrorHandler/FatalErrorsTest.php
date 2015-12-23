<?php

namespace Tests\Weew\ErrorHandler;

use PHPUnit_Framework_TestCase;
use Tests\Weew\ErrorHandler\Helpers\TestRunner;

class FatalErrorsTest extends PHPUnit_Framework_TestCase {
    public function test_fatal_handled_in_cli_mode() {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('fatal_handled.php');
        $this->assertStringEndsWith('handled fatal', $result);
    }

    public function test_fatal_unhandled_in_cli_mode() {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('fatal_unhandled.php');
        $this->assertStringStartsWith("\nFatal error", $result);
    }

    public function test_fatal_handled_in_http_mode() {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('fatal_handled.php');
        $this->assertEquals('handled fatal', $result);
    }

    public function test_fatal_unhandled_in_http_mode() {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('fatal_unhandled.php');
        $this->assertStringStartsWith("\nFatal error", $result);
    }
}
