<?php

namespace Weew\ErrorHandler\Errors;

interface IFatalError {
    /**
     * @return mixed
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
