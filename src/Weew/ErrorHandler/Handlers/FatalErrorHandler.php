<?php

namespace Weew\ErrorHandler\Handlers;

use Weew\ErrorHandler\Errors\IError;

class FatalErrorHandler implements IFatalErrorHandler {
    /**
     * @var callable
     */
    protected $handler;

    /**
     * FatalErrorHandler constructor.
     *
     * @param callable $handler
     */
    public function __construct(callable $handler) {
        $this->handler = $handler;
    }

    /**
     * @return callable
     */
    public function getHandler() {
        return $this->handler;
    }

    /**
     * @param IError $error
     *
     * @return bool
     */
    public function handle(IError $error) {
        $handled = $this->invokeHandler($this->getHandler(), $error);

        return $handled === false ? false : true;
    }

    /**
     * @param callable $handler
     * @param IError $error
     *
     * @return mixed
     */
    protected function invokeHandler(callable $handler, IError $error) {
        return $handler($error);
    }
}
