<?php

namespace Weew\ErrorHandler\Handlers;

use Weew\ErrorHandler\Errors\IError;

interface INativeErrorHandler {
    /**
     * @param IError $error
     *
     * @return bool
     */
    function handle(IError $error);
}
