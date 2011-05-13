<?php

// Perform bootstrapping, such as setting up the include path and error handlers
include 'system/core/bootstrap.php';

// Obtain request path
$requestPath = $_SERVER['REDIRECT_URL'];

// Find the appropriate script to redirect to
$scriptPath = system_web_Router::getScriptForRequest($requestPath);

// Include script matching the request, or 404 script, if the requested
// script was not found
if ($scriptPath !== false) {
	include($scriptPath);
} else {
	include 'handlers/404.php';
}
