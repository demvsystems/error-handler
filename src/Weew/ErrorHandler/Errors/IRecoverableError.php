<?php

namespace Weew\ErrorHandler\Errors;

interface IRecoverableError {
    /**
     * @return mixed
     */
    function getNumber();

    /**
     * @return mixed
     */
    function getString();

    /**
     * @return mixed
     */
    function getFile();

    /**
     * @return mixed
     */
    function getLine();
}
