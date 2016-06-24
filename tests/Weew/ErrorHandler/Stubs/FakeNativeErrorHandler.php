<?php

namespace Tests\Weew\ErrorHandler\Stubs;

use Weew\ErrorHandler\Errors\IError;
use Weew\ErrorHandler\Handlers\INativeErrorHandler;

class FakeNativeErrorHandler implements INativeErrorHandler {
    private $enabled = true;
    
    public function handle(IError $error) {
        return true;
    }

    public function isEnabled() {
        return $this->enabled;
    }

    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }
}
