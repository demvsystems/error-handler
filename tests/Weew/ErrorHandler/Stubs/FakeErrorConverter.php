<?php

namespace Tests\Weew\ErrorHandler\Stubs;

use Weew\ErrorHandler\ErrorConverter;
use Weew\ErrorHandler\ErrorType;

class FakeErrorConverter extends ErrorConverter {
    /**
     * @var
     */
    private $type;

    public function __construct($type = ErrorType::PARSE) {
        $this->type = $type;
    }

    protected function getLastError() {
        return [
            'type' => $this->type,
            'message' => 'bar',
            'file' => 'yolo',
            'line' => 'swag',
        ];
    }
}
