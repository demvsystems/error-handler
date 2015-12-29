<?php

namespace Tests\Weew\ErrorHandler\Stubs;

use Weew\ErrorHandler\Errors\IError;
use Weew\ErrorHandler\Handlers\IRecoverableErrorHandler;

class FakeRecoverableErrorHandler implements IRecoverableErrorHandler {
    /**
     * @param IError $error
     *
     * @return bool
     */
    public function handle(IError $error) {
        return true;
    }
}
