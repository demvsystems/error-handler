<?php

namespace Tests\Weew\ErrorHandler\Stubs;

use Weew\ErrorHandler\ErrorConverter;
use Weew\ErrorHandler\ErrorType;

class FakeErrorConverter extends ErrorConverter {
    protected function getLastError() {
        return [
            'type' => ErrorType::PARSE,
            'message' => 'bar',
            'file' => 'yolo',
            'line' => 'swag',
        ];
    }
}
