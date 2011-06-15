<?php

class ErrorHandler extends system_web_RequestHandler
{
	public function init()
	{
		
	}
	
	public function configurePage(system_web_Page $page)
	{
		$page->setTemplate('templates/default.tpl');
		$page->setTitle('Resource not found - ' . Configuration::SITE_NAME);
		$page->setMainHeading('Resource not found');
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
			new modules_navigation_NavigationLinksController(null,
				system_web_Services::getInstance()->getRequest());
		$page->addController(system_web_PageRegion::MAIN_NAV, $navController);
	    
		///////  THIS CODE SHOULD BE IN SOME CONTROLLER  ////////////
	    
		// Generate content
		$content = <<<EOF
			<p>
				The requested URL was not found on the server. If you cannot
				find what you are looking for, please contact the web master or
				system administrator.
			</p>
EOF;
	    
		/////////////////////////////////////////////////////////////////////
	
		$page->addController(system_web_PageRegion::CONTENT,
			new system_mvc_StaticController($content));
	}
}
