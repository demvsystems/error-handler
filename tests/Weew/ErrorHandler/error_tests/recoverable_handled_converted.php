<?php

use Weew\ErrorHandler\ErrorHandler;
use Weew\ErrorHandler\ErrorType;
use Weew\ErrorHandler\Exceptions\UserErrorException;

require __DIR__ . '/../../../../vendor/autoload.php';

$errorHandler = new ErrorHandler(true);
$errorHandler->enableRecoverableErrorHandling();
$errorHandler->enableExceptionHandling();

$errorHandler->addExceptionHandler(function(UserErrorException $ex) {
    echo 'handled recoverable converted ';

    return true;
});

trigger_error('error', ErrorType::USER_ERROR);

echo 'continue';
