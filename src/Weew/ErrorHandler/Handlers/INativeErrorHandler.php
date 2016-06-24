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

    /**
     * @return bool
     */
    function isEnabled();

    /**
     * @param bool $enabled
     */
    function setEnabled($enabled);
}
