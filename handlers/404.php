<?php

// Create request object
$request = system_web_Request::createFromCurrentRequest();

// Create root controller
$rootController = new system_mvc_CompositeController();

// Instantiate controllers
$navbarController =
	new modules_navigation_NavigationLinksController('404', $request);
$rootController->addChildController($navbarController);

// Handle all actions via root controller
$rootController->handleActions();

// Send 404 code in HTTP header
header('HTTP/1.0 404 Not Found');

// Obtain complete request URL
$completeUrl = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

// Generate content
$content = <<<EOF
	<p>
		The requested path is invalid for this site:
		<strong>$completeUrl</strong>
	</p>
EOF;

// Get configuration instance
$config = config_Configuration::getInstance();

// Instantiate page and set parameters
$page = new system_web_Page();
$page->setTitle('Invalid Path - ' . config_Configuration::SITE_NAME);
$page->setMainHeading('Invalid Path');
$page->addController(system_web_PageRegion::CONTENT, new system_mvc_StaticController($content));
$page->addController(system_web_PageRegion::MAIN_NAV, $navbarController);
if (!is_null(config_Configuration::COPANY_LOGO_PATH)) {
	$rootUrl = config_Configuration::getInstance()->getRootUrl();
	$page->setSiteLogo(sprintf('<a href="%s"><img src="%s" /></a>',
		$rootUrl, $rootUrl . config_Configuration::COPANY_LOGO_PATH));
}
if (!is_null(config_Configuration::FOOTER_HTML)) {
	$page->addController(system_web_PageRegion::FOOTER,
		new system_mvc_StaticController(config_Configuration::FOOTER_HTML));
}
$page->setTemplate('templates/default.tpl');

// Render page
$page->render();
