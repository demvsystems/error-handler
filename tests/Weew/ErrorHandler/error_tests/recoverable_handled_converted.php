<?php

use Weew\ErrorHandler\ErrorHandler;
use Weew\ErrorHandler\ErrorTypes;
use Weew\ErrorHandler\Exceptions\UserErrorException;

require __DIR__ . '/../../../../vendor/autoload.php';

$errorHandler = new ErrorHandler(true);
$errorHandler->enableRecoverableErrorHandling();
$errorHandler->enableExceptionHandling();

$errorHandler->addExceptionCallback(function(UserErrorException $ex) {
    echo 'handled recoverable converted ';
});

trigger_error('error', ErrorTypes::USER_ERROR);

echo 'continue';
