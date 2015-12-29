<?php

namespace Tests\Weew\ErrorHandler\Stubs;

use Weew\ErrorHandler\Errors\IError;
use Weew\ErrorHandler\Handlers\IFatalErrorHandler;

class FakeFatalErrorHandler implements IFatalErrorHandler {
    /**
     * @param IError $error
     *
     * @return bool|void
     */
    public function handle(IError $error) {
        return true;
    }
}
