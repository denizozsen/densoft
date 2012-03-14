<?php

class handlers_gpp_Topic extends system_web_PageRequestHandler
{
	public function configurePage(system_web_Page $page)
	{
		$page->setTemplate('templates/default.tpl');
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
	
		///////  PLACEHOLDER CONTENT (will be deleted later)  ////////////
		
		// Generate content
		$placeHolderContent = <<<EOF
			<h2>Placeholder for topic</h2>
			<p>
				[Topic text]
			</p>
EOF;
		
		/////////////////////////////////////////////////////////////////////
	
		// TODO - add topic detail controller, instead of placeholder content
		$page->addController(system_web_PageRegion::CONTENT,
			new system_mvc_StaticController($placeHolderContent));

		// Include topic name in title, get it from the topic detail controller
		$topicTitle = '[unknown topic]'; // TODO - get the topic name from the topic detail controller
		$page->setTitle("{$topicTitle} - Good Programming Practices");
	}
}
