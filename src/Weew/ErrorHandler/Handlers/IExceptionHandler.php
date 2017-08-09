<?php

namespace Weew\ErrorHandler\Handlers;

use Exception;

interface IExceptionHandler {
    /**
     * @param Exception $ex
     *
     * @return bool
     */
    function supports($ex);

    /**
     * @param Exception $ex
     *
     * @return bool
     */
    function handle($ex);

    /**
     * @return bool
     */
    function isEnabled();

    /**
     * @param bool $enabled
     */
    function setEnabled($enabled);
}
