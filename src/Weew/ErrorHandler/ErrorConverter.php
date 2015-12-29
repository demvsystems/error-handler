<?php

namespace Weew\ErrorHandler;

use Weew\ErrorHandler\Errors\FatalError;
use Weew\ErrorHandler\Errors\IError;
use Weew\ErrorHandler\Errors\RecoverableError;

class ErrorConverter {
    /**
     * @param IErrorHandler $handler
     * @param $number
     * @param $string
     * @param $file
     * @param $line
     *
     * @return bool|void
     */
    public function createRecoverableErrorAndCallHandler(
        IErrorHandler $handler,
        $number,
        $string,
        $file,
        $line
    ) {
        $error = new RecoverableError($number, $string, $file, $line);

        return $handler->handleRecoverableError($error);
    }

    /**
     * @param IErrorHandler $handler
     *
     * @return bool|void
     */
    public function extractFatalErrorAndCallHandler(IErrorHandler $handler) {
        $error = $this->getLastError();

        if ($error === null) {
            return;
        }

        $error = new FatalError(
            array_get($error, 'type'),
            array_get($error, 'message'),
            array_get($error, 'file'),
            array_get($error, 'line')
        );

        return $handler->handleFatalError($error);
    }

    /**
     * @param IErrorHandler $handler
     * @param IError $error
     */
    public function convertErrorToExceptionAndCallHandler(
        IErrorHandler $handler,
        IError $error
    ) {
        $handler->handleException(
            ErrorTypes::createExceptionForError($error)
        );
    }

    /**
     * @return array
     */
    protected function getLastError() {
        return error_get_last();
    }
}
