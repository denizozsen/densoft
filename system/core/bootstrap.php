<?php

// TODO - Append the auto-loader to the set of existing auto-loaders
// TODO - test if the require_once for ClassNotFoundException is needed
// Declare auto-loader first, to avoid require statements in following code
//require_once 'system/core/ClassNotFoundException.php';
/**
 * Auto-load handler that expects that class names match the full path of the
 * file in which they are declared, with slashes replaced by underscores, e.g.
 * class system_core_Services is declared in file
 * system/core/Services.php.
 *
 * @param string $className the name of the class to load
 */
function __autoload($className)
{
	$pathToClassFile = str_replace('_', '/', $className) . '.php';
	if (file_exists($pathToClassFile)) {
		require($pathToClassFile);
	} else {
		throw new system_core_ClassNotFoundException();
	}
}

// Set handlers for uncaught exceptions and for errors
set_exception_handler('handleUncaughtException');
set_error_handler('handleError');

// Set include path to be the document root
set_include_path($_SERVER['DOCUMENT_ROOT']);

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
