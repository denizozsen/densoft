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

// Let request handler handle the request
$requestHandler->handle();
