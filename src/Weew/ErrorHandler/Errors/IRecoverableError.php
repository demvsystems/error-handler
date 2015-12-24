<?php

namespace Weew\ErrorHandler\Errors;

interface IRecoverableError {
    /**
     * @return int
     */
    function getNumber();

    /**
     * @return string
     */
    function getString();

    /**
     * @return string
     */
    function getFile();

    /**
     * @return int
     */
    function getLine();
}
