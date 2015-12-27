<?php

namespace Weew\ErrorHandler\Exceptions;

use Exception;
use Weew\ErrorHandler\ErrorTypes;

class FatalException extends Exception
    implements IErrorException {
    /**
     * @var int
     */
    protected $errorType;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @var string
     */
    protected $errorFile;

    /**
     * @var int
     */
    protected $errorLine;

    /**
     * FatalException constructor.
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
        $this->errorType = $errorType;
        $this->errorMessage = $errorMessage;
        $this->errorFile = $errorFile;
        $this->errorLine = $errorLine;

        parent::__construct($this->formatErrorMessage());
    }

    /**
     * @return bool
     */
    public function isRecoverable() {
        return false;
    }

    /**
     * @return int
     */
    public function getErrorType() {
        return $this->errorType;
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
            ErrorTypes::getErrorType($this->getErrorType()),
            $this->getErrorMessage(),
            $this->getErrorFile(),
            $this->getErrorLine()
        );
    }
}
