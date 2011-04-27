<?php

class templates_TwoColumns extends system_web_Page
{
	protected $siteLogo;
	protected $topBarController;
	protected $pageHeading;
	protected $breadcrumbs;
	protected $leftColumnController;
	protected $contentColumnController;
	protected $footer;
	
	public function __construct()
	{
		// Call base class constructor
		parent::__construct('templates/TwoColumns_Markup.php');

		// Set default 'dummy' values
		$this->siteLogo                = '[site logo]';
		$this->topBarController        = new system_mvc_StaticController('[top bar]');
		$this->pageHeading             = '[page heading]';
		$this->breadcrumbs             = '[bread crumbs]';
		$this->navbarColumnController  = new system_mvc_StaticController('[nav bar column]');
		$this->contentColumnController = new system_mvc_StaticController('[content column]');
		$this->footer                  = '[footer]';

		// Set default site logo, if set in Configuration)
		$this->setDefaultSiteLogo();

		// Set default footer, if set in Configuration)
		if (!is_null(config_Configuration::FOOTER_HTML)) {
			$this->footer = config_Configuration::FOOTER_HTML;
		}
	}

	public function setSiteLogo($siteLogo)
	{
		$this->siteLogo = $siteLogo;
	}

	public function setTopBarController($topBarController)
	{
		$this->topBarController = $topBarController;
	}

	public function setPageHeading($pageHeading)
	{
		$this->pageHeading = $pageHeading;
	}

	public function setBreadcrumbs($breadcrumbs)
	{
		$this->breadcrumbs = $breadcrumbs;
	}

	public function addNavbarColumnController(system_mvc_Controller $navbarColumnController)
	{
		if ($this->navbarColumnController instanceof system_mvc_StaticController) {
			$this->navbarColumnController = new system_mvc_CompositeController();
		}

		$this->navbarColumnController->addChildController($navbarColumnController);
	}

	public function addContentColumnController(system_mvc_Controller $contentColumnController)
	{
		if ($this->contentColumnController instanceof system_mvc_StaticController) {
			$this->contentColumnController = new system_mvc_CompositeController();
		}

		$this->contentColumnController->addChildController($contentColumnController);
	}

	public function setFooter($footer)
	{
		$this->footer = $footer;
	}

	private function setDefaultSiteLogo()
	{
		if (!is_null(config_Configuration::COPANY_LOGO_PATH)) {
			$rootUrl = config_Configuration::getInstance()->getRootUrl();
			$this->siteLogo =
				sprintf('<a href="%s"><img src="%s" /></a>',
					$rootUrl, $rootUrl . config_Configuration::COPANY_LOGO_PATH);
		}
	}
}
