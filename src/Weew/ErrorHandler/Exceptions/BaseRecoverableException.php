<?php

namespace Weew\ErrorHandler\Exceptions;

use Exception;

abstract class BaseRecoverableException extends Exception {
    /**
     * @var string
     */
    protected $errorNumber;

    /**
     * @var int
     */
    protected $errorString;

    /**
     * @var Exception
     */
    protected $errorFile;

    /**
     * @var
     */
    protected $errorLine;

    /**
     * BaseRecoverableException constructor.
     *
     * @param int $errorNumber
     * @param string $errorString
     * @param string $errorFile
     * @param int $errorLine
     */
    public function __construct(
        $errorNumber,
        $errorString,
        $errorFile,
        $errorLine
    ) {
        parent::__construct();

        $this->errorNumber = $errorNumber;
        $this->errorString = $errorString;
        $this->errorFile = $errorFile;
        $this->errorLine = $errorLine;
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
    public function getErrorNumber() {
        return $this->errorNumber;
    }

    /**
     * @return string
     */
    public function getErrorString() {
        return $this->errorString;
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
