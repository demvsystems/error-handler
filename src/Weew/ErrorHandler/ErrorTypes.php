<?php

namespace Weew\ErrorHandler;

class ErrorTypes {
    /**
     * All errors and warnings, as supported,
     * except of level E_STRICT prior to PHP 5.4.0.
     */
    const ALL = E_ALL;

    /**
     * Fatal run-time errors. These indicate errors that can not be
     * recovered from, such as a memory allocation problem.
     * Execution of the script is halted.
     */
    const ERROR = E_ERROR;

    /**
     * Run-time warnings (non-fatal errors).
     * Execution of the script is not halted.
     */
    const WARNING = E_WARNING;

    /**
     * Compile-time parse errors. Parse errors should
     * only be generated by the parser.
     */
    const PARSE = E_PARSE;

    /**
     * Run-time notices. Indicate that the script encountered something
     * that could indicate an error, but could also happen in the normal
     * course of running a script.
     */
    const NOTICE = E_NOTICE;

    /**
     * Enable to have PHP suggest changes to your code which will
     * ensure the best interoperability and forward compatibility of your code.
     */
    const STRICT = E_STRICT;

    /**
     * Run-time notices. Enable this to receive warnings about code that
     * will not work in future versions.
     */
    const DEPRECATED = E_DEPRECATED;

    /**
     * Fatal errors that occur during PHP's initial startup.
     * This is like an E_ERROR, except it is generated by the core of PHP.
     */
    const CORE_ERROR = E_CORE_ERROR;

    /**
     * Warnings (non-fatal errors) that occur during PHP's initial startup.
     * This is like an E_WARNING, except it is generated by the core of PHP.
     */
    const CORE_WARNING = E_CORE_WARNING;

    /**
     * Fatal compile-time errors. This is like an E_ERROR, except
     * it is generated by the Zend Scripting Engine.
     */
    const COMPILE_ERROR = E_COMPILE_ERROR;

    /**
     * Compile-time warnings (non-fatal errors). This is like an E_WARNING,
     * except it is generated by the Zend Scripting Engine.
     */
    const COMPILE_WARNING = E_COMPILE_WARNING;

    /**
     * User-generated error message. This is like an E_ERROR, except it is
     * generated in PHP code by using the PHP function trigger_error().
     */
    const USER_ERROR = E_USER_ERROR;

    /**
     * User-generated warning message. This is like an E_WARNING, except it is
     * generated in PHP code by using the PHP function trigger_error().
     */
    const USER_WARNING = E_USER_WARNING;

    /**
     * User-generated notice message. This is like an E_NOTICE, except it is
     * generated in PHP code by using the PHP function trigger_error().
     */
    const USER_NOTICE = E_USER_NOTICE;

    /**
     * User-generated warning message. This is like an E_DEPRECATED, except
     * it is generated in PHP code by using the PHP function trigger_error().
     */
    const USER_DEPRECATED = E_USER_DEPRECATED;

    /**
     * Catchable fatal error. It indicates that a probably dangerous error
     * occurred, but did not leave the Engine in an unstable state.
     * If the error is not caught by a user defined handle
     * (see also set_error_handler()), the application aborts
     * as it was an E_ERROR.
     */
    const RECOVERABLE_ERROR = E_RECOVERABLE_ERROR;

    /**
     * @return array
     */
    public static function getRecoverableErrors() {
        return [
            self::WARNING, self::NOTICE, self::DEPRECATED,
            self::USER_ERROR, self::USER_WARNING, self::USER_NOTICE,
            self::USER_DEPRECATED, self::RECOVERABLE_ERROR,
        ];
    }

    /**
     * @return array
     */
    public static function getNonRecoverableErrors() {
        return [
            self::ERROR, self::PARSE, self::STRICT,
            self::CORE_ERROR, self::CORE_WARNING,
            self::COMPILE_ERROR, self::COMPILE_WARNING,
        ];
    }

    /**
     * @param $error
     *
     * @return bool
     */
    public static function isRecoverable($error) {
        return in_array($error, self::getRecoverableErrors());
    }

    /**
     * @return array
     */
    public static function getErrorTypes() {
        return [
            E_ERROR => 'E_ERROR',
            E_WARNING => 'E_WARNING',
            E_PARSE => 'E_PARSE',
            E_NOTICE => 'E_NOTICE',
            E_CORE_ERROR => 'E_CORE_ERROR',
            E_CORE_WARNING => 'E_CORE_WARNING',
            E_COMPILE_ERROR => 'E_COMPILE_ERROR',
            E_COMPILE_WARNING => 'E_COMPILE_WARNING',
            E_USER_ERROR => 'E_USER_ERROR',
            E_USER_WARNING => 'E_USER_WARNING',
            E_USER_NOTICE => 'E_USER_NOTICE',
            E_STRICT => 'E_STRICT',
            E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
            E_DEPRECATED => 'E_DEPRECATED',
            E_USER_DEPRECATED => 'E_USER_DEPRECATED',
            E_ALL => 'E_ALL',
        ];
    }

    /**
     * @param $error
     *
     * @return string
     */
    public static function getErrorType($error) {
        return array_get(self::getErrorTypes(), $error);
    }
}
