<?php

namespace Weew\ErrorHandler\Handlers;

use Weew\ErrorHandler\Errors\IFatalError;

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
     * @param IFatalError $error
     *
     * @return bool
     */
    public function handle(IFatalError $error) {
        $handled = $this->invokeHandler($this->getHandler(), $error);

        return $handled === false ? false : true;
    }

    /**
     * @param callable $handler
     * @param IFatalError $error
     *
     * @return mixed
     */
    protected function invokeHandler(callable $handler, IFatalError $error) {
        return $handler($error);
    }
}
