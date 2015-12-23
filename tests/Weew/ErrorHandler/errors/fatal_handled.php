<?php

use Weew\ErrorHandler\ErrorHandler;
use Weew\ErrorHandler\ErrorTypes;

require __DIR__ . '/../../../../vendor/autoload.php';

$errorHandler = new ErrorHandler();
$errorHandler->enableFatalErrorHandling();

$errorHandler->addFatalErrorHandler(function() {
    echo 'handled fatal';
});

trigger_error('error', ErrorTypes::USER_ERROR);
