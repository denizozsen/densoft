<?php

// Perform bootstrapping, such as setting up which configuration to use,
// the include path, error handlers etc
include 'system/core/bootstrap.php';

// Obtain the request object
$request = system_web_Services::getInstance()->getRequest();

// Initialise request object
$rawRequestPath = system_webutils_Urls::getCurrentRequestUri();
$requestPathElements =
	system_web_Services::getInstance()->getRouter()->splitRequestPath($rawRequestPath);
$request->setRawPath($rawRequestPath);
$request->setHandlerPath($requestPathElements);
$request->setArguments($_GET);
$request->setCommandArguments($_POST);

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
