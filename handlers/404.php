<?php

// Create request object
$request = system_web_Request::createFromCurrentRequest();

// Create root controller
$rootController = new system_mvc_CompositeController();

// Instantiate controllers
$rootController->addChildController(
    $navbarController = new modules_navigation_NavigationLinksController('about', $request));

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
// TODO - some things should go into the config, and be read by base class: Page
//        E.g.: company logo and theme !!!
$page = new templates_TwoColumns();
$page->setPageTitle('Invalid Path - ' . config_Configuration::SITE_NAME);
$page->setPageHeading('Invalid Path');
$page->addContentColumnController(new system_web_StaticController($content));
$page->addNavbarColumnController($navbarController);

// Render page
$page->render();
