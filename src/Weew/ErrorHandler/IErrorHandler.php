<?php

namespace Weew\ErrorHandler;

use Exception;
use Weew\ErrorHandler\Errors\IError;
use Weew\ErrorHandler\Handlers\IExceptionHandler;
use Weew\ErrorHandler\Handlers\INativeErrorHandler;

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
     * Enable handling of native PHP errors.
     */
    function enableErrorHandling();

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
     * @return bool
     */
    function isErrorHandlingEnabled();

    /**
     * @return bool
     */
    function isConvertingErrorsToExceptions();

    /**
     * Add an error handler for exceptions.
     *
     * @param callable|IExceptionHandler $handler
     */
    function addExceptionHandler($handler);

    /**
     * Add an error handler for all kinds of native PHP errors.
     *
     * @param callable|INativeErrorHandler $handler
     */
    function addErrorHandler($handler);

    /**
     * Add an error handler for recoverable, native PHP errors.
     *
     * @param callable|INativeErrorHandler $handler
     */
    function addRecoverableErrorHandler($handler);

    /**
     * Add an error handler for fatal, native PHP errors.
     *
     * @param callable|INativeErrorHandler $handler
     */
    function addFatalErrorHandler($handler);

    /**
     * @param Exception $ex
     */
    function handleException($ex);

    /**
     * @param IError $error
     */
    function handleError(IError $error);

    /**
     * @param IError $error
     *
     * @return bool|null
     */
    function handleRecoverableError(IError $error);

    /**
     * @param IError $error
     */
    function handleFatalError(IError $error);

    /**
     * @param bool $convertErrorsToExceptions
     */
    function convertErrorsToExceptions($convertErrorsToExceptions);
}
