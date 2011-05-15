<?php

// Perform bootstrapping, such as setting up the include path and error handlers
include 'system/core/bootstrap.php';

// Create request object and pass it to system_web_Services
system_web_Services::getInstance()->setRequest(
	system_web_Router::createRequest($_SERVER['REDIRECT_URL']));

// Obtain the request handler
$requestHandler =
	system_web_Services::getInstance()->getRequest()->getHandler();

// Let request handler perform any necessary initialisation
$requestHandler->init();

// Add controllers supplied by the handler
$requestHandler->configurePage(system_web_Services::getInstance()->getPage());

// Execute any commands issued by the client
$requestHandler->executeCommands();

// Render the response
$requestHandler->renderResponse();

// TODO - Implement 404 error in new framework! Note: the following commented code used to do this:

// Include script matching the request, or 404 script, if the requested
// script was not found
//if ($scriptPath !== false) {
//	include($scriptPath);
//} else {
//	include 'handlers/404.php';
//}
