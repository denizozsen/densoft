<?php

/**
 * Base page implementation.
 *
 * @author Deniz �zsen
 */
class system_web_Page
{
	private $markupTemplateFile;
	private $regionControllers = array();

	protected $title = '[untitled]';
	protected $themeCss;
	protected $otherCssList   = array();
	protected $javascriptList = array();

	public function __construct($markupTemplateFile)
	{
		$this->markupTemplateFile = $markupTemplateFile;

		$this->regionControllers = array();
		$this->regionControllers[system_web_PageArea::CONTENT] = null;
		$this->regionControllers[system_web_PageArea::CONTENT] = null;
		$this->regionControllers[system_web_PageArea::CONTENT] = null;
		$this->regionControllers[system_web_PageArea::CONTENT] = null;
		$this->regionControllers[system_web_PageArea::CONTENT] = null;
		$this->regionControllers[system_web_PageArea::CONTENT] = null;

		// Set default theme CSS path, if set in Configuration)
		if (!is_null(config_Configuration::THEME_PATH)) {
			$this->themeCss =
				config_Configuration::getInstance()->getRootUrl()
					. config_Configuration::THEME_PATH;
		}
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
