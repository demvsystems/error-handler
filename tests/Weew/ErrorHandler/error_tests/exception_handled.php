<?php

use Tests\Weew\ErrorHandler\Stubs\FooException;
use Weew\ErrorHandler\ErrorHandler;

require __DIR__ . '/../../../../vendor/autoload.php';

$errorHandler = new ErrorHandler();
$errorHandler->enableExceptionHandling();

$errorHandler->addExceptionHandler(function(FooException $ex) {
    echo 'handled exception';

    return true;
});

throw new FooException();
