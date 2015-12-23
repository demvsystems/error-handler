<?php

namespace Weew\ErrorHandler;

use Exception;

interface IErrorHandler {
    /**
     * Enable error handling.
     */
    function enable();

    /**
     * Handle exceptions.
     */
    function enableExceptionHandling();

    /**
     * Handle non fatal errors.
     */
    function enableRecoverableErrorHandling();

    /**
     * Handle fatal errors.
     */
    function enableFatalErrorHandling();

    /**
     * @return bool
     */
    function isExceptionHandlingEnabled();

    /**
     * @return bool
     */
    function isRecoverableErrorHandlingEnabled();

    /**
     * @return bool
     */
    function isFatalErrorHandlingEnabled();

    /**
     * @param callable $handler
     */
    function addExceptionHandler(callable $handler);

    /**
     * @param callable $handler
     */
    function addRecoverableErrorHandler(callable $handler);

    /**
     * @param callable $handler
     */
    function addFatalErrorHandler(callable $handler);

    /**
     * @param Exception $ex
     */
    function handleException(Exception $ex);

    /**
     * @param $number
     * @param $string
     * @param $file
     * @param $line
     *
     * @return mixed
     */
    function handleRecoverableError($number, $string, $file, $line);

    /**
     * @param $type
     * @param $message
     * @param $file
     * @param $line
     *
     * @return mixed
     */
    function handleFatalError($type, $message, $file, $line);
}
