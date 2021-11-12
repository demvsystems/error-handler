<?php

namespace Tests\Weew\ErrorHandler\Stubs;

use Throwable;
use Weew\ErrorHandler\Handlers\IExceptionHandler;

class FakeExceptionHandler implements IExceptionHandler {
    public $id;

    /**
     * @return int|mixed
     */
    public static function make(int $id): self
    {
        return new self($id);
    }

    public function __construct($id = 1)
    {
        $this->id = $id;
    }

    private $enabled = true;

    public function supports(Throwable $ex) {
        return $ex instanceof FooException;
    }

    public function handle(Throwable $ex) {
        return true;
    }

    public function isEnabled() {
        return $this->enabled;
    }

    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }
}
