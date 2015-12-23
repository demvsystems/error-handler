<?php

namespace Weew\ErrorHandler\Handlers;

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
     * @param $number
     * @param $string
     * @param $file
     * @param $line
     *
     * @return bool
     */
    public function handle($number, $string, $file, $line) {
        $handled = $this->invokeHandler(
            $this->getHandler(), $number, $string, $file, $line
        );

        return $handled === false ? false : true;
    }

    protected function invokeHandler(callable $handler, $number, $string, $file, $line) {
        return $handler($number, $string, $file, $line);
    }
}
