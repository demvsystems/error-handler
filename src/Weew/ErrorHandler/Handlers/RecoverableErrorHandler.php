<?php

namespace Weew\ErrorHandler\Handlers;

use Weew\ErrorHandler\Errors\IRecoverableError;

class RecoverableErrorHandler implements IRecoverableErrorHandler {
    /**
     * @var callable
     */
    protected $handler;

    /**
     * RecoverableErrorHandler constructor.
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
     * @param IRecoverableError $error
     *
     * @return bool
     */
    public function handle(IRecoverableError $error) {
        $handled = $this->invokeHandler($this->getHandler(), $error);

        return $handled === false ? false : true;
    }

    /**
     * @param callable $handler
     * @param IRecoverableError $error
     *
     * @return mixed
     */
    protected function invokeHandler(callable $handler, IRecoverableError $error) {
        return $handler($error);
    }
}
