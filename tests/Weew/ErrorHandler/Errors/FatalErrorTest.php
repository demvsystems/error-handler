<?php

namespace Tests\Weew\ErrorHandler\Errors;

use PHPUnit_Framework_TestCase;
use Weew\ErrorHandler\Errors\FatalError;

class FatalErrorTest extends PHPUnit_Framework_TestCase {
    public function test_getters() {
        $error = new FatalError('foo', 'bar', 'yolo', 'swag');
        $this->assertEquals('foo', $error->getType());
        $this->assertEquals('bar', $error->getMessage());
        $this->assertEquals('yolo', $error->getFile());
        $this->assertEquals('swag', $error->getLine());
    }
}
