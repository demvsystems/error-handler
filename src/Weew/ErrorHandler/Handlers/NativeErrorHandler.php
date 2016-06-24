<?php

namespace Weew\ErrorHandler\Handlers;

use Weew\ErrorHandler\Errors\IError;

class NativeErrorHandler implements INativeErrorHandler {
    /**
     * @var callable
     */
    protected $handler;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * NativeErrorHandler constructor.
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
