<?php

namespace Tests\Weew\ErrorHandler\Stubs;

use Exception;
use Weew\ErrorHandler\Handlers\IExceptionHandler;

class FakeExceptionHandler implements IExceptionHandler {
    /**
     * @param Exception $ex
     *
     * @return bool
     */
    public function supports(Exception $ex) {
        return $ex instanceof FooException;
    }

    /**
     * @param Exception $ex
     *
     * @return bool
     */
    public function handle(Exception $ex) {
        return true;
    }
}
