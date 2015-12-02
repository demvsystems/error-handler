<?php

namespace Weew\ErrorHandler;

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
     * @param Exception $exception
     *
     * @return bool
     */
    public function supports(Exception $exception) {
        $parents = class_parents($exception);
        $exceptionClass = get_class($exception);

        $instanceof = $exceptionClass === $this->getExceptionClass();
        $extends = is_array($parents) && in_array($this->getExceptionClass(), $parents);

        return $instanceof || $extends;
    }

    /**
     * @param Exception $exception
     *
     * @return bool
     */
    public function handle(Exception $exception) {
        if ( ! $this->supports($exception)) {
            return false;
        }

        $result = $this->invokeHandler($this->getHandler(), $exception);

        if ($result === false) {
            return false;
        }
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
