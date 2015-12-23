<?php

namespace Weew\ErrorHandler\Errors;

interface IFatalError {
    /**
     * @return mixed
     */
    function getType();

    /**
     * @return mixed
     */
    function getMessage();

    /**
     * @return mixed
     */
    function getFile();

    /**
     * @return mixed
     */
    function getLine();
}
