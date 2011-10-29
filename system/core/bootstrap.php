<?php

// Set include path to be the document root
set_include_path($_SERVER['DOCUMENT_ROOT']);

// Create and register auto-loader first, to avoid require statements in following code
/**
 * Auto-load handler that expects that class names match the full path of the
 * file in which they are declared, with slashes replaced by underscores, e.g.
 * class system_core_Services is declared in file
 * system/core/Services.php.
 *
 * @param string $className the name of the class to load
 */
function densoft_autoload($className)
{
	$pathToClassFile = str_replace('_', '/', $className) . '.php';
	if (file_exists($pathToClassFile)) {
		require($pathToClassFile);
	} else {
		throw new system_core_ClassNotFoundException();
	}
}
spl_autoload_register('densoft_autoload');

// Set configuration appropriate for current environment
$lowercaseServerName = strtolower($_SERVER['SERVER_NAME']);
if (strpos($lowercaseServerName, strtolower('local')) === 0) {
	Configuration::setInstance(new config_LocalConfiguration());
} elseif (strpos($lowercaseServerName, strtolower('test')) === 0) {
	Configuration::setInstance(new config_TestConfiguration());
} else {
	Configuration::setInstance(new config_LiveConfiguration());
}
unset($lowercaseServerName);

// Set default Services instances (by passing null to setInstance)
system_core_Services::setInstance(null);
system_web_Services::setInstance(null);

// Set timezone
date_default_timezone_set(Configuration::instance()->timezone());

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
