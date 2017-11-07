<?php

namespace Weew\ErrorHandler\Handlers;

use Throwable;

interface IExceptionHandler {
    /**
     * @param Throwable $ex
     *
     * @return bool
     */
    public function supports(Throwable $ex);

    /**
     * @param Throwable $ex
     *
     * @return bool
     */
    public function handle(Throwable $ex);

    /**
     * @return bool
     */
    public function isEnabled();

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled);
}
