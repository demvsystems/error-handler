<?php

namespace Weew\ErrorHandler\Handlers;

use Exception;

interface IExceptionHandler {
    /**
     * @param Exception $ex
     *
     * @return bool
     */
    function supports(Exception $ex);

    /**
     * @param Exception $ex
     *
     * @return bool
     */
    function handle(Exception $ex);

    /**
     * @return bool
     */
    function isEnabled();

    /**
     * @param bool $enabled
     */
    function setEnabled($enabled);
}
