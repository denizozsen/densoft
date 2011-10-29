<?php

// Bootstrap
include 'bootstrap.php';

// Obtain the request object
$request = system_web_Services::instance()->getRequest();

// Initialise request object
$rawRequestPath = system_webutils_Urls::getCurrentRequestUri();
$requestPathElements =
	system_web_Services::instance()->getRouter()->splitRequestPath($rawRequestPath);
$request->setRawPath($rawRequestPath);
$request->setHandlerPath($requestPathElements);
$request->setArguments($_GET);
$request->setCommandArguments($_POST);

// Obtain request handler path
$requestHandlerData = system_web_Services::instance()
	->getRouter()->getHandlerDataAndCompleteRequest($request);

// Include additional bootstrapper, if it exists
if (file_exists($requestHandlerData['dir'] . 'bootstrap.php')) {
    include $requestHandlerData['dir'] . 'bootstrap.php';
}

// Instantiate request handler and pass it the request object
$requestHandlerClassName = $requestHandlerData['class'];
$requestHandler = new $requestHandlerClassName();
$requestHandler->setRequest($request);

// Unset variables that are no longer necessary, to avoid global variables
unset($request);
unset($requestHandlerData);
unset($requestHandlerClassName);

// Let request handler handle the request
$requestHandler->handle();
