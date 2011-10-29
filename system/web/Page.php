<?php

/**
 * Base page implementation.
 *
 * @author Deniz Ozsen
 */
class system_web_Page extends system_mvc_View
{
	private $regionControllers = array();

	protected $title = '[untitled]';
	protected $mainHeading;
	protected $siteLogo;
	protected $breadcrumbs;
	protected $themeCss;
	protected $otherCssList   = array();
	protected $javascriptList = array();

	public function __construct()
	{
		$this->regionControllers = array();
		$this->regionControllers[system_web_PageRegion::CONTENT]      = new system_mvc_CompositeController();
		$this->regionControllers[system_web_PageRegion::HEADING]      = new system_mvc_CompositeController();
		$this->regionControllers[system_web_PageRegion::TOP_BAR]      = new system_mvc_CompositeController();
		$this->regionControllers[system_web_PageRegion::MAIN_NAV]     = new system_mvc_CompositeController();
		$this->regionControllers[system_web_PageRegion::LEFT_COLUMN]  = new system_mvc_CompositeController();
		$this->regionControllers[system_web_PageRegion::RIGHT_COLUMN] = new system_mvc_CompositeController();
		$this->regionControllers[system_web_PageRegion::FOOTER]       = new system_mvc_CompositeController();

		// Set default theme CSS path, if set in Configuration)
		if (!is_null(Configuration::instance()->themePath())) {
			$this->themeCss =
				Configuration::instance()->rootUrl()
					. Configuration::instance()->themePath();
		}
	}

	public function addController($pageRegion, system_mvc_Controller $controller)
	{
	    if (!array_key_exists($pageRegion, $this->regionControllers)) {
	        throw new Exception("Unknown page region: {$pageRegion}"); // TODO - throw specific exception
	    }

	    $this->regionControllers[$pageRegion]->addChildController($controller);
	}

	public function getControllers($pageRegion = null)
	{
	    if (!is_null($pageRegion)) {
            
    	    if (!array_key_exists($pageRegion, $this->regionControllers)) {
    	        throw new Exception("Unknown page region: {$pageRegion}"); // TODO - throw specific exception
    	    }
	        return $this->regionControllers[$pageRegion];
            
	    } else {
	        
	        $allControllers = array();
	        foreach($this->regionControllers as $controllersForRegion) {
	            $allControllers[] = $controllersForRegion;
	        }
	        return $allControllers;
	        
	    }
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setMainHeading($mainHeading)
	{
		$this->mainHeading = $mainHeading;
	}

	public function setSiteLogo($siteLogo)
	{
		$this->siteLogo = $siteLogo;
	}
	
	public function setBreadcrumbs($breadcrumbs)
	{
		$this->breadcrumbs = $breadcrumbs;
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

	public function render(array $renderArgs = array())
	{
		// Save data required by template into local variables, which will
		// be accessible by the template (included below)
		$pageRenderArgs = array(
			'mainHeading' => $this->mainHeading,
			'siteLogo'    => $this->siteLogo,
			'breadcrumbs' => $this->breadcrumbs,
			'headElement' => $this->generateHeadElement(),
			'content'     => $this->regionControllers[system_web_PageRegion::CONTENT],
		    'footer'      => $this->regionControllers[system_web_PageRegion::FOOTER],
		    'heading'     => $this->regionControllers[system_web_PageRegion::HEADING],
		    'leftColumn'  => $this->regionControllers[system_web_PageRegion::LEFT_COLUMN],
		    'mainNav'     => $this->regionControllers[system_web_PageRegion::MAIN_NAV],
		    'rightColumn' => $this->regionControllers[system_web_PageRegion::RIGHT_COLUMN],
		    'topBar'      => $this->regionControllers[system_web_PageRegion::TOP_BAR]
		);
	    
	    parent::render($pageRenderArgs);
	}
	
	private function generateHeadElement()
	{
		// Starting tag for head, meta and title tags
		$headElement = '<head>' . PHP_EOL;
		$headElement .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />' . PHP_EOL;
		$headElement .= "    <title>{$this->title}</title>" . PHP_EOL;

		// Theme CSS link tag
		if (!is_null($this->themeCss)) {
			$headElement .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->themeCss}\" />" . PHP_EOL;
		}

		// Link tags for other CSS files in head tag
		if (count($this->otherCssList) != 0) {
			foreach($this->otherCssList as $extraCss) {
				$headElement .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"{$extraCss}\" />" . PHP_EOL;
			}
		}

		// Script tags for javascript files in head tag
		if (count($this->otherCssList) != 0) {
			foreach($this->javascriptList as $javascript) {
				$headElement .= "    <script type=\"text/javascript\" src=\"{$javascript}\" />" . PHP_EOL;
			}
		}

		// End tag for head
		$headElement .= '</head>' . PHP_EOL;

		// Render complete head element
		return $headElement;
	}
}
