<?php

namespace Tests\Weew\ErrorHandler\Stubs;

use Weew\ErrorHandler\Errors\IError;
use Weew\ErrorHandler\Handlers\INativeErrorHandler;

class FakeNativeErrorHandler implements INativeErrorHandler {
    /**
     * @param IError $error
     *
     * @return bool
     */
    public function handle(IError $error) {
        return true;
    }
}
