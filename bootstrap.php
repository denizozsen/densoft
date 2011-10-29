<?php

// Include path
set_include_path($_SERVER['DOCUMENT_ROOT']);

// Set up autoload handler function
include 'autoload.php';

// Use configuration appropriate for current environment
$lowercaseServerName = strtolower($_SERVER['SERVER_NAME']);
if (strpos($lowercaseServerName, strtolower('local')) === 0) {
	Configuration::setInstance(new config_LocalConfiguration());
} elseif (strpos($lowercaseServerName, strtolower('test')) === 0) {
	Configuration::setInstance(new config_TestConfiguration());
} else {
	Configuration::setInstance(new config_LiveConfiguration());
}
unset($lowercaseServerName);

// Use default Services instances (by passing null to setInstance)
system_core_Services::setInstance(null);
system_web_Services::setInstance(null);

// Use configured timezone
date_default_timezone_set(Configuration::instance()->timezone());

// Set up error and exception handlers
include 'errorhandlers.php';
