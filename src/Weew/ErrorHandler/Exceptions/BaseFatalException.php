<?php

namespace Weew\ErrorHandler\Exceptions;

use Exception;

class BaseFatalException extends Exception {
    /**
     * @var mixed
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
     * BaseFatalException constructor.
     *
     * @param mixed $errorType
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
        parent::__construct();

        $this->errorType = $errorType;
        $this->errorMessage = $errorMessage;
        $this->errorFile = $errorFile;
        $this->errorLine = $errorLine;
    }

    /**
     * @return bool
     */
    public function isRecoverable() {
        return false;
    }

    /**
     * @return mixed
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
}
