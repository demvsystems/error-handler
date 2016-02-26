<?php

use Weew\ErrorHandler\ErrorHandler;
use Weew\ErrorHandler\ErrorType;

require __DIR__ . '/../../../../vendor/autoload.php';

$errorHandler = new ErrorHandler(true);
$errorHandler->enableFatalErrorHandling();
$errorHandler->enableExceptionHandling();

trigger_error('error', ErrorType::USER_ERROR);
