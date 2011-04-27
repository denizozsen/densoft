<?php

// Create request object
$request = system_web_Request::createFromCurrentRequest();

// Create root controller
$rootController = new system_mvc_CompositeController();

// Create child controllers
$navbarController = new modules_navigation_NavigationLinksController(null, $request);
$rootController->addChildController($navbarController);

// Handle all actions via root controller
$rootController->handleActions();

///////  THIS CODE SHOULD BE HANDLED IN SOME CONTROLLER  ////////////

// Obtain all tasks from db and build up mark-up
$db = system_core_Application::getInstance()->getDb();
$allTasks = $db->runQueryAndReturnAllRows('SELECT * FROM task');
$numTasks = count($allTasks);

// Generate tasks table
$tasksTableMarkup = '';

// Generate content
$content = <<<EOF
	<h2>Welcome to Home Monitor</h2>
	<p>
		[A short introduction]
	</p>

	<h2>Tasks</h2>
	<p>Number of tasks: {$numTasks}</p>
	{$tasksTableMarkup}
EOF;

/////////////////////////////////////////////////////////////////////

// Instantiate page and set parameters
$page = new templates_TwoColumns();
$page->setPageTitle('Task List - ' . config_Configuration::SITE_NAME);
$page->setPageHeading('Task List');
$page->addContentColumnController(new system_web_StaticController($content));
$page->addNavbarColumnController($navbarController);

// Render page
$page->render();
