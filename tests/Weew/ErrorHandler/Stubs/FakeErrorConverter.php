<?php

namespace Tests\Weew\ErrorHandler\Stubs;

use Weew\ErrorHandler\ErrorConverter;
use Weew\ErrorHandler\ErrorTypes;

class FakeErrorConverter extends ErrorConverter {
    protected function getLastError() {
        return [
            'type' => ErrorTypes::PARSE,
            'message' => 'bar',
            'file' => 'yolo',
            'line' => 'swag',
        ];
    }
}
