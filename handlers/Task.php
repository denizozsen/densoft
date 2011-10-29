<?php

class handlers_Task extends system_web_PageRequestHandler
{
	public function configurePage(system_web_Page $page)
	{
	    // Template
		$page->setTemplate('templates/default.tpl');
		
		// Stylesheet
		$page->addOtherCss('/modules/tasks/view/tasks.css');
		
		// Controllers
        $page->addController(system_web_PageRegion::MAIN_NAV,
            $navbarController = new modules_navigation_NavigationLinksController('task', $this->getRequest()));
        $page->addController(system_web_PageRegion::CONTENT,
            $taskDetailsController = new modules_tasks_TaskDetailsController($this->getRequest()));
		
        // Page settings
        $taskName = $taskDetailsController->getModel()->getName();
        $page->setTitle("Task: '{$taskName}' - " . Configuration::instance()->siteName());
		$page->setMainHeading("Task: '{$taskName}'");
		
		// Site Logo
		if (!is_null(Configuration::instance()->companyLogoPath())) {
			$rootUrl = Configuration::instance()->rootUrl();
			$page->setSiteLogo(sprintf('<a href="%s"><img src="%s" /></a>',
				$rootUrl, $rootUrl . Configuration::instance()->companyLogoPath()));
		}
		
		// Footer
		if (!is_null(Configuration::instance()->footerHtml())) {
			$page->addController(system_web_PageRegion::FOOTER,
				new system_mvc_StaticController(Configuration::instance()->footerHtml()));
		}
	}
}
