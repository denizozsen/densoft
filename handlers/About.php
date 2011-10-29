<?php

class handlers_About extends system_web_PageRequestHandler
{
	public function configurePage(system_web_Page $page)
	{
		$page->setTemplate('templates/default.tpl');
		$page->setTitle('About - ' . Configuration::instance()->siteName());
		$page->setMainHeading('About');
		if (!is_null(Configuration::instance()->companyLogoPath())) {
			$rootUrl = Configuration::instance()->rootUrl();
			$page->setSiteLogo(sprintf('<a href="%s"><img src="%s" /></a>',
				$rootUrl, $rootUrl . Configuration::instance()->companyLogoPath()));
		}
		if (!is_null(Configuration::instance()->footerHtml())) {
			$page->addController(system_web_PageRegion::FOOTER,
				new system_mvc_StaticController(Configuration::instance()->footerHtml()));
		}
		
		$navController =
			new modules_navigation_NavigationLinksController('about',
				system_web_Services::instance()->getRequest());
		$page->addController(system_web_PageRegion::MAIN_NAV, $navController);
	    
		///////  THIS CODE SHOULD BE IN SOME CONTROLLER  ////////////
		
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
		
		/////////////////////////////////////////////////////////////////////
	    
		$page->addController(system_web_PageRegion::CONTENT,
			new system_mvc_StaticController($content));
	}
}
