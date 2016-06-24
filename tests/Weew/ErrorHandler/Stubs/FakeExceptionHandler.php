<?php

namespace Tests\Weew\ErrorHandler\Stubs;

use Exception;
use Weew\ErrorHandler\Handlers\IExceptionHandler;

class FakeExceptionHandler implements IExceptionHandler {
    private $enabled = true;

    public function supports(Exception $ex) {
        return $ex instanceof FooException;
    }

    public function handle(Exception $ex) {
        return true;
    }

    public function isEnabled() {
        return $this->enabled;
    }

    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }
}
