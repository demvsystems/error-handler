<?php

namespace Tests\Weew\ErrorHandler\Stubs;

use Throwable;
use Weew\ErrorHandler\Handlers\IExceptionHandler;

class FakeExceptionHandler implements IExceptionHandler {
    private $enabled = true;

    public function supports(Throwable $ex) {
        return $ex instanceof FooException;
    }

    public function handle(Throwable $ex) {
        return true;
    }

    public function isEnabled() {
        return $this->enabled;
    }

    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }
}
