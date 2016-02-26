<?php

use Weew\ErrorHandler\ErrorHandler;
use Weew\ErrorHandler\ErrorType;

require __DIR__ . '/../../../../vendor/autoload.php';

$errorHandler = new ErrorHandler();
$errorHandler->enableRecoverableErrorHandling();

trigger_error('error', ErrorType::USER_ERROR);

echo 'continue';
