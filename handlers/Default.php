<?php

class handlers_Default extends system_web_PageRequestHandler
{
	public function configurePage(system_web_Page $page)
	{
		$page->setTemplate('templates/default.tpl');
		$page->setTitle('Task List - ' . Configuration::instance()->siteName());
		$page->addController(system_web_PageRegion::HEADING, new system_mvc_StaticController('Task List'));
		if (!is_null(Configuration::instance()->logoPath())) {
			$rootUrl = Configuration::instance()->rootUrl();
		    $page->addController(
		        system_web_PageRegion::LOGO,
		        new system_mvc_StaticController(
		            sprintf('<a href="%s"><img src="%s" /></a>', $rootUrl, $rootUrl . Configuration::instance()->logoPath())
		        )
		    );
		}
		if (!is_null(Configuration::instance()->footerHtml())) {
			$page->addController(system_web_PageRegion::FOOTER,
				new system_mvc_StaticController(Configuration::instance()->footerHtml()));
		}
		
		$navController =
			new modules_navigation_NavigationLinksController(null,
				system_web_Services::instance()->getRequest());
		$page->addController(system_web_PageRegion::MAIN_NAV, $navController);
	
		///////  THIS CODE SHOULD BE IN SOME CONTROLLER  ////////////
	
		// Obtain all tasks from db and build up mark-up
		$db = system_core_Services::instance()->getDb();
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
	
		$page->addController(system_web_PageRegion::CONTENT,
			new system_mvc_StaticController($content));
	}
}
