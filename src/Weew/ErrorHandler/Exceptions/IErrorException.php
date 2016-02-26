<?php

namespace Weew\ErrorHandler\Exceptions;

interface IErrorException {
    /**
     * @return int
     */
    function getErrorCode();

    /**
     * @return string
     */
    function getErrorMessage();

    /**
     * @return string
     */
    function getErrorFile();

    /**
     * @return int
     */
    function getErrorLine();

    /**
     * @return bool
     */
    function isRecoverable();
}
