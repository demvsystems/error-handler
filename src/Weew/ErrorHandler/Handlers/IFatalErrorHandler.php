<?php

namespace Weew\ErrorHandler\Handlers;

use Weew\ErrorHandler\Errors\IError;

interface IFatalErrorHandler {
    /**
     * @param IError $error
     *
     * @return bool
     */
    function handle(IError $error);
}
