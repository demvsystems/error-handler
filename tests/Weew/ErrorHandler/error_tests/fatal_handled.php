<?php

use Weew\ErrorHandler\ErrorHandler;
use Weew\ErrorHandler\ErrorType;

require __DIR__ . '/../../../../vendor/autoload.php';

$errorHandler = new ErrorHandler();
$errorHandler->enableFatalErrorHandling();

$errorHandler->addFatalErrorHandler(function() {
    echo 'handled fatal';

    return true;
});

trigger_error('error', ErrorType::FOO);
