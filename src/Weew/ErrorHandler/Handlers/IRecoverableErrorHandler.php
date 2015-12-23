<?php

namespace Weew\ErrorHandler\Handlers;

use Weew\ErrorHandler\Errors\IRecoverableError;

interface IRecoverableErrorHandler {
    /**
     * @param IRecoverableError $error
     *
     * @return bool
     */
    function handle(IRecoverableError $error);
}
