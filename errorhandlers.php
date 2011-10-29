<?php

// Set handlers for uncaught exceptions and for errors
set_exception_handler('handleUncaughtException');
set_error_handler('handleError');

////////////////////

// Handlers

/**
 * Handler for any uncaught exception.
 * Note: This function must be declared in the global scope in order for
 *       to be able to register it with set_exception_handler.
 *
 * @param Exception $exception an exception
 */
function handleUncaughtException($exception)
{
    echo "<p>Uncaught exception: {$exception->getMessage()}</p>";
}

/**
 * TODO - Include all info in thrown exception!
 * Handler for any PHP error.
 *
 * @param unknown_type $errno
 * @param unknown_type $errstr
 * @param unknown_type $errfile
 * @param unknown_type $errline
 * @param unknown_type $errcontext
 */
function handleError($errno, $errstr, $errfile, $errline, $errcontext)
{
	$message =
		"Error in {$errfile} (line {$errline}): {$errstr}";

	throw new Exception($message, $errno);
}
