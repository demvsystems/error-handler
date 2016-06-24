<?php

use Weew\ErrorHandler\ErrorHandler;
use Weew\ErrorHandler\ErrorType;

require __DIR__ . '/../../../../vendor/autoload.php';

$errorHandler = new ErrorHandler();
$errorHandler->enableRecoverableErrorHandling();

$errorHandler->addRecoverableErrorHandler(function() {
    echo 'handled recoverable ';

    return true;
});

trigger_error('error', ErrorType::USER_ERROR);

echo 'continue';
