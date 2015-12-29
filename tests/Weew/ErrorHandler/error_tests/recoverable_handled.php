<?php

use Weew\ErrorHandler\ErrorHandler;
use Weew\ErrorHandler\ErrorTypes;

require __DIR__ . '/../../../../vendor/autoload.php';

$errorHandler = new ErrorHandler();
$errorHandler->enableRecoverableErrorHandling();

$errorHandler->addRecoverableErrorCallback(function() {
    echo 'handled recoverable ';
});

trigger_error('error', ErrorTypes::USER_ERROR);

echo 'continue';
