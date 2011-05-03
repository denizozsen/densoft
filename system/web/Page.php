<?php

/**
 * Base page implementation.
 *
 * @author Deniz Ozsen
 */
class system_web_Page
{
	private $regionControllers = array();
	private $templateFile;

	protected $title = '[untitled]';
	protected $themeCss;
	protected $otherCssList   = array();
	protected $javascriptList = array();

	public function __construct()
	{
		$this->regionControllers = array();
		$this->regionControllers[system_web_PageArea::CONTENT]      = array();
		$this->regionControllers[system_web_PageArea::HEADING]      = array();
		$this->regionControllers[system_web_PageArea::TOP_BAR]      = array();
		$this->regionControllers[system_web_PageArea::MAIN_NAV]     = array();
		$this->regionControllers[system_web_PageArea::LEFT_COLUMN]  = array();
		$this->regionControllers[system_web_PageArea::RIGHT_COLUMN] = array();
		$this->regionControllers[system_web_PageArea::FOOTER]       = array();

		// Set default theme CSS path, if set in Configuration)
		if (!is_null(config_Configuration::THEME_PATH)) {
			$this->themeCss =
				config_Configuration::getInstance()->getRootUrl()
					. config_Configuration::THEME_PATH;
		}
	}

	public function addController($pageRegion, system_mvc_Controller $controller)
	{
	    if (!array_key_exists($pageRegion, $this->regionControllers)) {
	        throw new Exception("Unknown page region: {$pageRegion}"); // TODO - throw specific exception
	    }

	    $this->regionControllers[$pageRegion] = $controller;
	}

	public function getControllers($pageRegion = null)
	{
	    if (!is_null($pageRegion)) {
	        return $this->regionControllers[$pageRegion];
	    } else {
	        $allControllers = array();
	        foreach($this->regionControllers as $controllersForRegion) {
	            array_merge($allControllers, $controllersForRegion);
	        }
	        return $allControllers;
	    }
	}

	public function setTemplate($templateFile)
	{
		$this->templateFile = $templateFile;
	}

	public function setPageTitle($title)
	{
		$this->title = $title;
	}

	public function setThemeCss($themeCss)
	{
		$this->themeCss = $themeCss;
	}

	public function addOtherCss($otherCss)
	{
		$this->otherCssList[] = $otherCss;
	}

	public function addJavascript($javascript)
	{
		$this->javascriptList[] = $javascript;
	}

	public function renderHead()
	{
		// Starting tag for head, meta and title tags
		$head = '<head>' . PHP_EOL;
		$head .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />' . PHP_EOL;
		$head .= "    <title>{$this->title}</title>" . PHP_EOL;

		// Theme CSS link tag
		if (!is_null($this->themeCss)) {
			$head .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->themeCss}\" />" . PHP_EOL;
		}

		// Link tags for other CSS files in head tag
		if (count($this->otherCssList) != 0) {
			foreach($this->otherCssList as $extraCss) {
				$head .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"{$extraCss}\" />" . PHP_EOL;
			}
		}

		// Script tags for javascript files in head tag
		if (count($this->otherCssList) != 0) {
			foreach($this->javascriptList as $javascript) {
				$head .= "    <script type=\"text/javascript\" src=\"{$javascript}\" />" . PHP_EOL;
			}
		}

		// End tag for head
		$head .= '</head>' . PHP_EOL;

		// Render complete head element
		echo $head;
	}

	public function render()
	{
		include($this->markupTemplateFile);
	}
}
