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

// Generate content
$content = <<<EOF
	<h2>Welcome to the Home Monitor</h2>
	<p>
		[This is where the description of Home Monitor goes.]
	</p>

	<h2>Where do I start?</h2>
	<p>
		[Here goes a list of pointers: where to start, interesting functionality, etc.]
	</p>
EOF;

// Get configuration instance
$config = Configuration::getInstance();

// Instantiate page and set parameters
$page = new templates_TwoColumns();
$page->setPageTitle('About - ' . Configuration::SITE_NAME);
$page->setPageHeading('About');
$page->addContentColumnController(new system_mvc_StaticController($content));
$page->addNavbarColumnController($navbarController);

// Render page
$page->render();
