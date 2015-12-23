<?php

namespace Weew\ErrorHandler;

use Exception;
use Weew\ErrorHandler\Errors\IFatalError;
use Weew\ErrorHandler\Errors\IRecoverableError;

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
     * @param IRecoverableError $error
     *
     * @return bool|null
     */
    function handleRecoverableError(IRecoverableError $error);

    /**
     * @param IFatalError $error
     *
     * @return bool|null
     */
    function handleFatalError(IFatalError $error);
}
