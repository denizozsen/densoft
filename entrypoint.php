<?php

// TODO - Avoid require'ing each specific Configuration sub-class
// Make sure WebApplication instance is created and initialised
// NOTE: It's necessary that this is done before any other code is run,
//       so that certain things are set up, such as the include path.
require_once 'system/core/Application.php';
require_once 'system/web/WebApplication.php';
require_once 'config/Configuration.php';
require_once 'config/LocalConfiguration.php';
require_once 'config/TestConfiguration.php';
require_once 'config/LiveConfiguration.php';
system_web_WebApplication::getInstance();

// Define class auto-loader function
// The auto-loader expects that class names match the full path of the file
// in which they are declared, with slashes replaced by underscores, e.g.
// class system_core_Application is declared in file system/core/Application.php
require_once 'system/core/ClassNotFoundException.php';
function __autoload($className)
{
	$pathToClassFile = str_replace('_', '/', $className) . '.php';
	if (file_exists($pathToClassFile)) {
		require($pathToClassFile);
	} else {
		throw new system_core_ClassNotFoundException();
	}
}

// Obtain request path
$requestPath = $_SERVER['REDIRECT_URL'];

// Try to find the appropriate script to redirect to
$scriptPath = system_web_Router::getScriptForRequest($requestPath);

// Include script matching the request, or 404 script, if no match was found
if ($scriptPath !== false) {
	include($scriptPath);
} else {
	include 'pages/404.php';
}
