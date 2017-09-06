<?php

namespace Weew\ErrorHandler\Handlers;

use Throwable;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionParameter;

class ExceptionHandler implements IExceptionHandler {
    /**
     * @var callable
     */
    protected $handler;

    /**
     * @var null|string
     */
    protected $exceptionClass;

    /**
     * @var bool
     */
    protected $enabled = true;

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
     * @param Throwable $ex
     *
     * @return bool
     */
    public function supports(Throwable $ex) {
        $instanceof = get_class($ex) === $this->getExceptionClass();
        $extends = is_subclass_of($ex, $this->getExceptionClass());

        return $instanceof || $extends;
    }

    /**
     * @param Throwable $ex
     *
     * @return bool
     */
    public function handle(Throwable  $ex) {
        if ( ! $this->supports($ex)) {
            return false;
        }

        $handled = $this->invokeHandler($this->getHandler(), $ex);

        return $handled === true ? true : false;
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
     * @return bool
     */
    public function isEnabled() {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    /**
     * @param $handler
     *
     * @return null|string
     */
    protected function parseExceptionClass(callable $handler) {
        $parameters = $this->getReflectionParameters($handler);

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
     * @param callable  $handler
     * @param Throwable $throwable
     *
     * @return mixed
     */
    protected function invokeHandler(callable $handler, Throwable $throwable) {
        return $handler($throwable);
    }

    /**
     * @param callable $handler
     *
     * @return ReflectionParameter[]
     */
    protected function getReflectionParameters(callable $handler) {
        if (is_array($handler)) {
            $reflector = new ReflectionMethod($handler[0], $handler[1]);
        } else {
            $reflector = new ReflectionFunction($handler);
        }

        return $reflector->getParameters();
    }
}
