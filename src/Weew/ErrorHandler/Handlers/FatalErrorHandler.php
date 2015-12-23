<?php

namespace Weew\ErrorHandler\Handlers;

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
     * @param $type
     * @param $message
     * @param $file
     * @param $line
     *
     * @return bool
     */
    public function handle($type, $message, $file, $line) {
        $handled = $this->invokeHandler(
            $this->getHandler(), $type, $message, $file, $line
        );

        return $handled === false ? false : true;
    }

    /**
     * @param callable $handler
     * @param $type
     * @param $message
     * @param $file
     * @param $line
     *
     * @return mixed
     */
    protected function invokeHandler(callable $handler, $type, $message, $file, $line) {
        return $handler($type, $message, $file, $line);
    }
}
