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

    public function test_recoverable_unhandled_in_cli_mode() {
        $runner = new TestRunner();
        $result = $runner->runInCliMode('recoverable_unhandled.php');
        $this->assertStringStartsWith("\nFatal error", $result);
    }

    public function test_recoverable_handled_in_http_mode() {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('recoverable_handled.php');
        $this->assertEquals('handled recoverable continue', $result);
    }

    public function test_recoverable_unhandled_in_http_mode() {
        $runner = new TestRunner();
        $result = $runner->runInHttpMode('recoverable_unhandled.php');
        $this->assertStringStartsWith("<br />\n<b>Fatal error</b>", $result);
    }
}
