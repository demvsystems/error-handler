<?php

use Weew\ErrorHandler\ErrorHandler;
use Weew\ErrorHandler\ErrorType;
use Weew\ErrorHandler\Exceptions\UserErrorException;

require __DIR__ . '/../../../../vendor/autoload.php';

$errorHandler = new ErrorHandler(true);
$errorHandler->enableFatalErrorHandling();
$errorHandler->enableExceptionHandling();

$errorHandler->addExceptionHandler(function(UserErrorException $ex) {
    echo 'handled fatal converted';

    return true;
});

trigger_error('error', ErrorType::USER_ERROR);
