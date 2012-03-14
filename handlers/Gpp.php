<?php

class handlers_Gpp extends system_web_PageRequestHandler
{
	public function configurePage(system_web_Page $page)
	{
		$page->setTemplate('templates/default.tpl');
		$page->setTitle('Good Programming Practices - ' . Configuration::instance()->siteName());
		$page->setMainHeading('Good Programming Practices');
		if (!is_null(Configuration::instance()->logoPath())) {
			$rootUrl = Configuration::instance()->rootUrl();
			$page->setSiteLogo(sprintf('<a href="%s"><img src="%s" /></a>',
				$rootUrl, $rootUrl . Configuration::instance()->logoPath()));
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
			<h2>Overview of Good Programming Practices</h2>
			<p>
				[A short introduction]
			</p>
			
			<h2>Topics</h2>
			<ul>
				<li>Code Formatting</li>
				<li>In-Code documentation</li>
				<li>Testing Practices</li>
				<li>Peer Review</li>
			</ul>
EOF;
		
		/////////////////////////////////////////////////////////////////////
	
		$page->addController(system_web_PageRegion::CONTENT,
			new system_mvc_StaticController($content));
	}
}
