<?php

// Perform bootstrapping, such as setting up which configuration to use,
// the include path, error handlers etc
include 'system/core/bootstrap.php';

// Obtain the request object
$request = system_web_Services::getInstance()->getRequest();

// TODO - check that $_SERVER['REDIRECT_URL'] is reliable and secure
// Initialise request object
$rawRequestPath = $_SERVER['REDIRECT_URL'];
$requestPathElements =
	system_web_Services::getInstance()->getRouter()->splitRequestPath($rawRequestPath);
$request->setRawPath($rawRequestPath);
$request->setPath($requestPathElements);
$request->setParameters($_GET);
$request->setCommandParameters($_POST);

// Obtain request handler
$requestHandler = system_web_Services::getInstance()
	->getRouter()->findHandlerAndUpdateRequest($request);

// Unset the request object reference, to avoid global var
unset($request);

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
