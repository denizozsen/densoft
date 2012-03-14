<?php

/**
 * The View in the MVC (Model-View-Controller) concept.
 *
 * @author Deniz Ozsen
 */
class system_mvc_View implements system_mvc_Renderable
{
	private $templateFilePath;
	private $viewVariablesArray;
	
	public function __construct()
	{
	    $this->viewVariablesArray = array();
	}
		
	/**
	 * Sets the template that will be used when rendering the view.
	 * 
	 * @param string $templateFilePath the te
	 */
	public function setTemplate($templateFilePath)
	{
		$this->templateFilePath = $templateFilePath;
	}
	
	/**
	 * Returns the template that will be used when rendering the view.
	 */
	public function getTemplate()
	{
		return $this->templateFilePath;
	}
	
	/**
	 * Adds the variables in the given associative array to the View's variable
	 * collection.
	 * 
	 * @param array $variablesArray the variables to add to this View.
	 */
	public function addViewVariables($variablesArray)
	{
	    $this->viewVariablesArray =
	        array_merge($this->viewVariablesArray, $variablesArray);
	}
	
	/**
	 * Sets this View's variable collection.
	 * 
	 * @param array $viewVariablesArray an associative array
	 */
	public function setViewVariables($viewVariablesArray)
	{
	    $this->viewVariablesArray = $viewVariablesArray;
	}
	
	/**
	 * Returns this View's variable collection as an associative array.
	 * 
	 * @return array
	 */
	public function getViewVariables()
	{
	    return $this->viewVariablesArray;
	}
	
	// Magic get method, used by template to retrieve view variables
	private function __get($variableName)
	{
	    return $this->viewVariablesArray[$variableName];
	}
	
	// Magic set method, used by View client to assign view variables
	private function __set($variableName, $variableValue)
	{
	    $this->viewVariablesArray[$variableName] = $variableValue;
	}
	
	/**
	 * Renders the View by including the template that was set.
	 */
	public function render()
	{
		// Render view, based on template
	    include($this->templateFilePath);
	}
}
