<?php

namespace Weew\ErrorHandler\Handlers;

interface IRecoverableErrorHandler {
    /**
     * @param $number
     * @param $string
     * @param $file
     * @param $line
     *
     * @return bool
     */
    function handle($number, $string, $file, $line);
}
