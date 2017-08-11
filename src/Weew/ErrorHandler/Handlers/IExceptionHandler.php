<?php

namespace Weew\ErrorHandler\Handlers;

use Throwable;

interface IExceptionHandler {
    /**
     * @param Throwable $ex
     *
     * @return bool
     */
    function supports(Throwable $ex);

    /**
     * @param Throwable $ex
     *
     * @return bool
     */
    function handle(Throwable $ex);

    /**
     * @return bool
     */
    function isEnabled();

    /**
     * @param bool $enabled
     */
    function setEnabled($enabled);
}
