<?php

// Perform bootstrapping, such as setting up which configuration to use,
// the include path, error handlers etc
include 'system/core/bootstrap.php';

$request = system_web_Services::getInstance()->getRequest();

// Initialise request object
// TODO - check that $_SERVER['REDIRECT_URL'] is reliable and secure
system_web_Services::getInstance()->getRouter()->initRequestPathAndParams(
		$request, $_SERVER['REDIRECT_URL'], $_GET, $_POST);

// Obtain request handler
$requestHandler = system_web_Services::getInstance()
	->getRouter()->findHandlerAndUpdateRequest(system_web_Services::getInstance()->getRequest());

// Let request handler perform any necessary initialisation
$requestHandler->init();

// Let handler set up controllers and other page settings
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
