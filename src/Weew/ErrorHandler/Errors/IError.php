<?php

namespace Weew\ErrorHandler\Errors;

interface IError {
    /**
     * @return bool
     */
    function isRecoverable();

    /**
     * @return int
     */
    function getType();

    /**
     * @return string
     */
    function getMessage();

    /**
     * @return string
     */
    function getFile();

    /**
     * @return int
     */
    function getLine();
}
