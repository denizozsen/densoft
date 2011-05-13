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
$db = system_core_Services::getInstance()->getDb();
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
$page = new system_web_Page();
$page->setTitle('Task List - ' . config_Configuration::SITE_NAME);
$page->setMainHeading('Task List');
$page->addController(system_web_PageArea::CONTENT, new system_mvc_StaticController($content));
$page->addController(system_web_PageArea::MAIN_NAV, $navbarController);
if (!is_null(config_Configuration::COPANY_LOGO_PATH)) {
	$rootUrl = config_Configuration::getInstance()->getRootUrl();
	$page->setSiteLogo(sprintf('<a href="%s"><img src="%s" /></a>',
		$rootUrl, $rootUrl . config_Configuration::COPANY_LOGO_PATH));
}
if (!is_null(config_Configuration::FOOTER_HTML)) {
	$page->addController(system_web_PageArea::FOOTER,
		new system_mvc_StaticController(config_Configuration::FOOTER_HTML));
}
$page->setTemplate('templates/default.tpl');

// Render page
$page->render();
