<?php

namespace Weew\ErrorHandler\Exceptions;

use Exception;
use Weew\ErrorHandler\ErrorType;

abstract class RecoverableException extends Exception
    implements IErrorException{
    /**
     * @var int
     */
    protected $errorCode;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @var string
     */
    protected $errorFile;

    /**
     * @var string
     */
    protected $errorLine;

    /**
     * RecoverableException constructor.
     *
     * @param int $errorType
     * @param string $errorMessage
     * @param string $errorFile
     * @param int $errorLine
     */
    public function __construct(
        $errorType,
        $errorMessage,
        $errorFile,
        $errorLine
    ) {
        $this->errorCode = $errorType;
        $this->errorMessage = $errorMessage;
        $this->errorFile = $errorFile;
        $this->errorLine = $errorLine;

        parent::__construct($this->formatErrorMessage());
    }

    /**
     * @return bool
     */
    public function isRecoverable() {
        return true;
    }

    /**
     * @return int
     */
    public function getErrorCode() {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage() {
        return $this->errorMessage;
    }

    /**
     * @return string
     */
    public function getErrorFile() {
        return $this->errorFile;
    }

    /**
     * @return int
     */
    public function getErrorLine() {
        return $this->errorLine;
    }

    /**
     * @return string
     */
    protected function formatErrorMessage() {
        return s(
            '%s: %s in %s on line %s',
            ErrorType::getErrorTypeName($this->getErrorCode()),
            $this->getErrorMessage(),
            $this->getErrorFile(),
            $this->getErrorLine()
        );
    }
}
