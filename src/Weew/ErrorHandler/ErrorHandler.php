<?php

namespace Weew\ErrorHandler;

use Exception;
use Weew\ErrorHandler\Errors\FatalError;
use Weew\ErrorHandler\Errors\IError;
use Weew\ErrorHandler\Errors\RecoverableError;
use Weew\ErrorHandler\Handlers\ExceptionHandler;
use Weew\ErrorHandler\Handlers\FatalErrorHandler;
use Weew\ErrorHandler\Handlers\IExceptionHandler;
use Weew\ErrorHandler\Handlers\IFatalErrorHandler;
use Weew\ErrorHandler\Handlers\IRecoverableErrorHandler;
use Weew\ErrorHandler\Handlers\RecoverableErrorHandler;

class ErrorHandler implements IErrorHandler {
    /**
     * @var IExceptionHandler[]
     */
    protected $exceptionHandlers = [];

    /**
     * @var IRecoverableErrorHandler[]
     */
    protected $recoverableErrorHandlers = [];

    /**
     * @var IFatalErrorHandler[]
     */
    protected $fatalErrorHandlers = [];

    /**
     * @var bool
     */
    protected $isExceptionHandlingEnabled = false;

    /**
     * @var bool
     */
    protected $isRecoverableErrorHandlingEnabled = false;

    /**
     * @var bool
     */
    protected $isFatalErrorHandlingEnabled = false;

    /**
     * Enable exception, error and fatal error handling.
     */
    public function enable() {
        $this->enableExceptionHandling();
        $this->enableRecoverableErrorHandling();
        $this->enableFatalErrorHandling();
    }

    /**
     * Enable exception handling.
     */
    public function enableExceptionHandling() {
        if ($this->isExceptionHandlingEnabled()) {
            return;
        }

        set_exception_handler([$this, 'handleException']);
        $this->isExceptionHandlingEnabled = true;
    }

    /**
     * Enable regular error handling.
     */
    public function enableRecoverableErrorHandling() {
        if ($this->isRecoverableErrorHandlingEnabled()) {
            return;
        }

        set_error_handler(function($number, $string, $file, $line) {
            return $this->extractRecoverableErrorAndCallHandler(
                $number, $string, $file, $line
            );
        });
        $this->isRecoverableErrorHandlingEnabled = true;
    }

    /**
     * Enable fatal/non-recoverable error handling.
     */
    public function enableFatalErrorHandling() {
        if ($this->isFatalErrorHandlingEnabled()) {
            return;
        }

        register_shutdown_function(function () {
            return $this->extractFatalErrorAndCallHandler();
        });
        $this->isFatalErrorHandlingEnabled = true;
    }

    /**
     * @param callable $handler
     */
    public function addExceptionHandler(callable $handler) {
        $this->exceptionHandlers[] = $this->createExceptionHandler($handler);
    }

    /**
     * @param callable $handler
     */
    public function addRecoverableErrorHandler(callable $handler) {
        $this->recoverableErrorHandlers[] = $this->createRecoverableErrorHandler($handler);
    }

    /**
     * @param callable $handler
     */
    public function addFatalErrorHandler(callable $handler) {
        $this->fatalErrorHandlers[] = $this->createFatalErrorHandler($handler);
    }

    /**
     * @return bool
     */
    public function isExceptionHandlingEnabled() {
        return $this->isExceptionHandlingEnabled;
    }

    /**
     * @return bool
     */
    public function isRecoverableErrorHandlingEnabled() {
        return $this->isRecoverableErrorHandlingEnabled;
    }

    /**
     * @return bool
     */
    public function isFatalErrorHandlingEnabled() {
        return $this->isFatalErrorHandlingEnabled;
    }

    /**
     * @return IExceptionHandler[]
     */
    public function getExceptionHandlers() {
        return $this->exceptionHandlers;
    }

    /**
     * @return IRecoverableErrorHandler[]
     */
    public function getRecoverableErrorHandlers() {
        return $this->recoverableErrorHandlers;
    }

    /**
     * @return IFatalErrorHandler[]
     */
    public function getFatalErrorHandlers() {
        return $this->fatalErrorHandlers;
    }

    /**
     * @param Exception $ex
     *
     * @throws Exception
     */
    public function handleException(Exception $ex) {
        foreach ($this->getExceptionHandlers() as $handler) {
            if ( ! $handler->supports($ex)) {
                continue;
            }

            $handled = $handler->handle($ex);

            if ($handled === true) {
                return;
            }
        }

        throw $ex;
    }

    /**
     * @param IError $error
     *
     * @return bool|void
     */
    public function handleRecoverableError(IError $error) {
        foreach ($this->getRecoverableErrorHandlers() as $handler) {
            $handled = $handler->handle($error);

            if ($handled === true) {
                return;
            }
        }

        return false;
    }

    /**
     * @param IError $error
     *
     * @return bool|void
     */
    public function handleFatalError(IError $error) {
        ob_get_clean();

        foreach ($this->getFatalErrorHandlers() as $handler) {
            $handled = $handler->handle($error);

            if ($handled === true) {
                return;
            }
        }

        return false;
    }

    /**
     * @param callable $handler
     *
     * @return IExceptionHandler
     */
    protected function createExceptionHandler(callable $handler) {
        return new ExceptionHandler($handler);
    }

    /**
     * @param callable $handler
     *
     * @return IRecoverableErrorHandler
     */
    protected function createRecoverableErrorHandler(callable $handler) {
        return new RecoverableErrorHandler($handler);
    }

    /**
     * @param callable $handler
     *
     * @return IFatalErrorHandler
     */
    protected function createFatalErrorHandler(callable $handler) {
        return new FatalErrorHandler($handler);
    }

    /**
     * @param $number
     * @param $string
     * @param $file
     * @param $line
     *
     * @return bool|void
     */
    protected function extractRecoverableErrorAndCallHandler(
        $number,
        $string,
        $file,
        $line
    ) {
        $error = new RecoverableError($number, $string, $file, $line);

        return $this->handleRecoverableError($error);
    }

    /**
     * @return bool|void
     */
    protected function extractFatalErrorAndCallHandler() {
        $error = error_get_last();

        if ($error === null) {
            return;
        }

        $error = new FatalError(
            array_get($error, 'type'),
            array_get($error, 'message'),
            array_get($error, 'file'),
            array_get($error, 'line')
        );

        return $this->handleFatalError($error);
    }
}
