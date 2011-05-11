<?php

// Perform bootstrapping, such as setting up the include path and error handlers
include 'system/core/bootstrap.php';

// Make sure WebApplication instance is created and initialised
// NOTE: It's necessary that this is done before any other code is run,
//       to make sure that we are using a 'system_web_WebApplication' and not
//       just a plain 'system_core_Application'.
system_web_WebApplication::getInstance();

// Obtain request path
$requestPath = $_SERVER['REDIRECT_URL'];

// Try to find the appropriate script to redirect to
$scriptPath = system_web_Router::getScriptForRequest($requestPath);

// Include script matching the request, or 404 script, if no match was found
if ($scriptPath !== false) {
	include($scriptPath);
} else {
	include 'handlers/404.php';
}
