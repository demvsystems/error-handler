<?php

namespace Weew\ErrorHandler;

use Exception;
use Weew\ErrorHandler\Errors\IError;

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
     * @param IError $error
     *
     * @return bool|null
     */
    function handleRecoverableError(IError $error);

    /**
     * @param IError $error
     *
     * @return bool|null
     */
    function handleFatalError(IError $error);

    /**
     * @param bool $convertErrorsToExceptions
     */
    function convertErrorsToExceptions($convertErrorsToExceptions);

    /**
     * @return bool
     */
    function isConvertingErrorsToExceptions();
}
