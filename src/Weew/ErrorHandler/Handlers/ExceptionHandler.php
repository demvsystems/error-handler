<?php

namespace Weew\ErrorHandler\Handlers;

use Exception;
use ReflectionClass;
use ReflectionFunction;

class ExceptionHandler implements IExceptionHandler {
    /**
     * @var null|string
     */
    protected $exceptionClass;

    /**
     * ExceptionHandler constructor.
     *
     * @param callable $handler
     */
    public function __construct(callable $handler) {
        $this->handler = $handler;
        $this->exceptionClass = $this->parseExceptionClass($handler);
    }

    /**
     * @param Exception $ex
     *
     * @return bool
     */
    public function supports(Exception $ex) {
        $instanceof = get_class($ex) === $this->getExceptionClass();
        $extends = is_subclass_of($ex, $this->getExceptionClass());

        return $instanceof || $extends;
    }

    /**
     * @param Exception $ex
     *
     * @return bool
     */
    public function handle(Exception $ex) {
        if ( ! $this->supports($ex)) {
            return false;
        }

        $handled = $this->invokeHandler($this->getHandler(), $ex);

        return $handled === false ? false : true;
    }

    /**
     * @return null|string
     */
    public function getExceptionClass() {
        return $this->exceptionClass;
    }

    /**
     * @return callable
     */
    public function getHandler() {
        return $this->handler;
    }

    /**
     * @param $handler
     *
     * @return null|string
     */
    protected function parseExceptionClass($handler) {
        $reflector = new ReflectionFunction($handler);
        $parameters = $reflector->getParameters();

        if (count($parameters) > 0) {
            $parameter = $parameters[0];
            $parameterClass = $parameter->getClass();

            if ($parameterClass instanceof ReflectionClass) {
                return $parameterClass->getName();
            }
        }

        return null;
    }

    /**
     * @param callable $handler
     * @param Exception $exception
     *
     * @return mixed
     */
    protected function invokeHandler(callable $handler, Exception $exception) {
        return $handler($exception);
    }
}
