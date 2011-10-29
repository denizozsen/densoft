<?php

class handlers_Error extends system_web_PageRequestHandler
{
	public function configurePage(system_web_Page $page)
	{
		$page->setTemplate('templates/default.tpl');
		$page->setTitle('Resource not found - ' . Configuration::instance()->siteName());
		$page->setMainHeading('Resource not found');
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
			new modules_navigation_NavigationLinksController(null,
				system_web_Services::instance()->getRequest());
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
