<?php

namespace Weew\ErrorHandler\Handlers;

interface IFatalErrorHandler {
    /**
     * @param $type
     * @param $message
     * @param $file
     * @param $line
     *
     * @return bool
     */
    function handle($type, $message, $file, $line);
}
