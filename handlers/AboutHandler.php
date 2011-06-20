<?php

class AboutHandler extends system_web_RequestHandler
{
	public function init()
	{
		
	}
	
	public function configurePage(system_web_Page $page)
	{
		$page->setTemplate('templates/default.tpl');
		$page->setTitle('About - ' . Configuration::SITE_NAME);
		$page->setMainHeading('About');
		if (!is_null(Configuration::COPANY_LOGO_PATH)) {
			$rootUrl = Configuration::getInstance()->getRootUrl();
			$page->setSiteLogo(sprintf('<a href="%s"><img src="%s" /></a>',
				$rootUrl, $rootUrl . Configuration::COPANY_LOGO_PATH));
		}
		if (!is_null(Configuration::FOOTER_HTML)) {
			$page->addController(system_web_PageRegion::FOOTER,
				new system_mvc_StaticController(Configuration::FOOTER_HTML));
		}
		
		$navController =
			new modules_navigation_NavigationLinksController('about',
				system_web_Services::getInstance()->getRequest());
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
