<?php

namespace Weew\ErrorHandler;

use Exception;

interface IExceptionHandler {
    /**
     * @param Exception $exception
     *
     * @return bool
     */
    function supports(Exception $exception);

    /**
     * @param Exception $exception
     *
     * @return bool
     */
    function handle(Exception $exception);
}
