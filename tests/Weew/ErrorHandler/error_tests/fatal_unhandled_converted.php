<?php

use Weew\ErrorHandler\ErrorHandler;
use Weew\ErrorHandler\ErrorTypes;

require __DIR__ . '/../../../../vendor/autoload.php';

$errorHandler = new ErrorHandler(true);
$errorHandler->enableFatalErrorHandling();
$errorHandler->enableExceptionHandling();

trigger_error('error', ErrorTypes::USER_ERROR);
