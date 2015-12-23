<?php

namespace Weew\ErrorHandler\Handlers;

use Weew\ErrorHandler\Errors\IFatalError;

interface IFatalErrorHandler {
    /**
     * @param IFatalError $error
     *
     * @return bool
     */
    function handle(IFatalError $error);
}
