<?php

namespace Weew\ErrorHandler;

use Exception;
use Weew\ErrorHandler\Errors\IError;
use Weew\ErrorHandler\Handlers\IExceptionHandler;
use Weew\ErrorHandler\Handlers\IFatalErrorHandler;
use Weew\ErrorHandler\Handlers\IRecoverableErrorHandler;

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
     * @return bool
     */
    function isConvertingErrorsToExceptions();

    /**
     * @param callable|IExceptionHandler $handler
     */
    function addExceptionHandler($handler);

    /**
     * @param callable|IRecoverableErrorHandler $handler
     */
    function addRecoverableErrorHandler($handler);

    /**
     * @param callable|IFatalErrorHandler $handler
     */
    function addFatalErrorHandler($handler);

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
}
