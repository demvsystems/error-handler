# Error handler

[![Build Status](https://img.shields.io/travis/weew/php-error-handler.svg)](https://travis-ci.org/weew/php-error-handler)
[![Code Quality](https://img.shields.io/scrutinizer/g/weew/php-error-handler.svg)](https://scrutinizer-ci.com/g/weew/php-error-handler)
[![Test Coverage](https://img.shields.io/coveralls/weew/php-error-handler.svg)](https://coveralls.io/github/weew/php-error-handler)
[![Dependencies](https://img.shields.io/versioneye/d/php/weew:error-handler.svg)](https://versioneye.com/php/weew:error-handler)
[![Version](https://img.shields.io/packagist/v/weew/php-error-handler.svg)](https://packagist.org/packages/weew/php-error-handler)
[![Licence](https://img.shields.io/packagist/l/weew/php-error-handler.svg)](https://packagist.org/packages/weew/php-error-handler)

# Table of contents

- [Installation](#installation)
- [Introduction](#introduction)
- [Enabling error handling](#enabling-error-handling)
- [About error handlers](#about-error-handlers)
- [Error handling](#error-handling)
    - [Abstraction of PHP errors](#abstraction-of-php-errors)
    - [Handling recoverable PHP errors](#handling-recoverable-php-errors)
    - [Handling fatal PHP errors](#handling-fatal-php-errors)
    - [Handling both kinds of errors](#handling-both-kinds-of-errors)
    - [Sophisticated error handlers](#sophisticated-error-handlers)
- [Exception handling](#exception-handling)
    - [Exception handler callbacks](#exception-handler-callbacks)
    - [Sophisticated exception handlers](#sophisticated-exception-handlers)
- [Converting errors to exceptions](#converting-errors-to-exceptions)

## Installation

`composer require weew/php-error-handler`

## Introduction

This little library allows you to easily handle exceptions, recoverable and fatal errors globally in your code. Some types of errors are recoverable some are not, This kind of error handling should be used as last resort to do some logging, etc.

## Enabling error handling

You can manually toggle between three kinds of errors that the error handler can handle: exceptions, recoverable and fatal errors.

```php
$errorHandler = new ErrorHandler();

// enable exception handling
$errorHandler->enableExceptionHandling();

// enable handling of recoverable php errors
$errorHandler->enableRecoverableErrorHandling();

// enable handling of fatal php errors
$errorHandler->enableFatalErrorHandling();

// enable handling of recoverable and fatal php errors
$errorHandler->enableErrorHandling();

// enable handling of exceptions, recoverable and fatal php errors
$errorHandler->enable();
```

You can always check whether some kind of error handling has been enabled.

```php
$errorHandler->isExceptionHandlingEnabled();
$errorHandler->isRecoverableErrorHandlingEnabled();
$errorHandler->isFatalErrorHandlingEnabled();
```

## About error handlers

Error handlers are small pieces of logic that you can register on the `ErrorHandler`. There are two different kinds of handlers: error and exception handlers. They all follow the same pattern: a handler accepts and abstraction of the occurred error / exception and returns a `boolean` value determining whether the error has bee handled or not. Error handler assumes that the error has been handled by default, if not, you'll have to return `false` (always returning `true` is optional).

## Error handling

In PHP there are two different kind of errors, the ones that you can recover from and the ones you can't. You can differentiate between them if you want to. All PHP errors are converted to an instance of `IError`. It will contain all the relevant information about the occurred error and be passed down to your error handlers.

### Abstraction of PHP errors

All PHP errors are converted to an instance of `IError`. It serves as a holder for all the relevant error information and makes it accessible trough few getter methods.

```php
// is this kind of error recoverable or not
$error->isRecoverable();

// get error type (E_WARNING, E_STRICT, etc.)
$error->getType();

// get error message
$error->getMessage();

// get error file
$error->getFile();

// get error line
$error->getLine();
```

There is also a very useful `ErrorTypes` class that holds information about all kinds of PHP errors and might be used to get error type name based on the error type number, check if a particular type of error is recoverable or not, and so on.

### Handling recoverable PHP errors

Creating an error handler for recoverable errors.

```php
$errorHandler = new ErrorHandler();
$errorHandler->addRecoverableErrorHandler(function(IError $error) {

});
```

### Handling fatal PHP errors

Creating an error handler for fatal errors.

```php
$errorHandler = new ErrorHandler();
$errorHandler->addFatalErrorHandler(function(IError $error) {

});
```

### Handling both kinds of errors

Creating an error handler that covers both, recoverable and fatal errors.

```php
$errorHandler = new ErrorHandler();
$errorHandler->addErrorHandler(function(IError $error) {
    if ($error->isRecoverable()) {

    }
});
```

### Sophisticated error handlers

If you do not want to work with callbacks, you can create a sophisticated error handler class. All you have to do is to implement the `INativeErrorHandler` interface.

```php
class CustomErrorHandler implements INativeErrorHandler {
    public function handle(IError $error) {

    }
}

$errorHandler = new ErrorHandler();
$errorHandler->addErrorHandler(new CustomErrorHandler());
```

## Exception handling

Error handler allows you to define the types of exceptions you want to handle in your exception handler. There are two ways you can plug in an exception handler: using callbacks or using an implementation of the `IExceptionHandler` interface.

### Exception handler callbacks

When using simple callables / callbacks as exception handlers, all you have to do is to define the exception type in the function signature. Error handler will then figure out what kind of exceptions are supported by your exception handler and give it only the ones it can handle.

Below is an example of an exception handler that handles only exceptions of type HttpException or it's subclasses.

```php
$errorHandler = new ErrorHandler();
$errorHandler->addExceptionHandler(function(HttpException $ex) {

});
```

### Sophisticated exception handlers

You can add an exception handler by passing in an instance of `IExceptionHandler`. When an exception is thrown, error handler will ask your custom exception handler whether it supports this kind of exceptions and if so, ask your handler to handle this exception.

```php
class CustomExceptionHandler implements IExceptionHandler {
    public function supports(Exception $ex) {
        return $ex instanceof HttpException;
    }

    public function handle(HttpException $ex) {

    }
}

$errorHandler = new ErrorHandler();
$errorHandler->addExceptionHandler(new CustomExceptionHandler());
```

## Converting errors to exceptions

When a php errors occurres, it will be converted to an instance of `IError` and passed down to you error handlers. This requires you to differentiate between errors and exceptions. If you prefer dealing with errors as if they were regular exceptions, you can do so by telling the error handler to convert all php errors to appropriate exceptions. Do not forget to enable exception handling, otherwise you will not be able to handle them anymore.

```php
$errorHandler = new ErrorHandler();
$errorHandler->convertErrorsToExceptions();
$errorHandler->enableExceptionHandling();

// or

$errorHandler = new ErrorHandler(true);
$errorHandler->enableExceptionHandling();
```

Now, whenever for example an `E_WARNING` occurres, you'll get a `WarningException`. To handle all `WarningException` occurrences you can create a regular exception handler.

```php
$errorHandler->addExceptionHandler(function(WarningException $ex){

});
```

If you want to deal with all PHP errors that are converted to an exception in the same handler, you can create an exception handler for the `IErrorException` interface.

```php
$errorHandler->addExceptionHandler(function(IErrorException $ex) {
    // all kinds of php errors (E_WARNING, E_STRICT, etc.) can now be handled
    // here in form of an exception
});
```

Below is a full list of available exceptions.

- `E_COMPILE_ERROR` -> [CompileErrorException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/CompileErrorException.php)
- `E_COMPILE_WARNING` -> [CompileWarningException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/CompileWarningException.php)
- `E_CORE_ERROR` -> [CoreErrorException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/CoreErrorException.php)
- `E_CORE_WARNING` -> [CoreWarningException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/CoreWarningException.php)
- `E_DEPRECATED` -> [DeprecatedException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/DeprecatedException.php)
- `E_ERROR` -> [ErrorException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/ErrorException.php)
- `E_DEPRECATED` -> [DeprecatedException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/DeprecatedExceptions/Exception.php)
- `E_ERROR` -> [ErrorException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/ErrorException.php)
- `E_NOTICE` -> [NoticeException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/NoticeException.php)
- `E_PARSE` -> [ParseException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/ParseException.php)
- `E_RECOVERABLE_ERROR` -> [RecoverableErrorException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/RecoverableErrorException.php)
- `E_STRICT` -> [StrictException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/StrictException.php)
- `E_USER_DEPRECATED` -> [UserDeprecatedException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/UserDeprecatedException.php)
- `E_USER_ERROR` -> [UserErrorException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/UserErrorException.php)
- `E_USER_NOTICE` -> [UserNoticeException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/UserNoticeException.php)
- `E_USER_WARNING` -> [UserWarningException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/UserWarningException.php)
- `E_WARNING` -> [WarningException](https://github.com/weew/php-error-handler/blob/master/src/Weew/ErrorHandler/Exceptions/WarningException.php)

All exceptions listed above share the same `IErrorException` interface that offers some getters to access the error information.

```php
// get numeric representation of the error type (E_WARNING, E_STRICT, etc.)
$ex->getErrorType();

// get error message
$ex->getErrorMessage();

// get error file
$ex->getErrorFile();

// get error line
$ex->getErrorLine();

// check wether the error was recoverable or not
$ex->isRecoverable();
```
