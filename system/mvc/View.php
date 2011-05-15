<?php

/**
 * The View in the MVC (Model-View-Controller) concept.
 *
 * @author Deniz Ozsen
 */
class system_mvc_View implements system_mvc_Renderable
{
	private $templateFilePath;
	
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
		return $this->templateFile;
	}
	
	/**
	 * Renders the view by making each element in the given renderArgs array
	 * a local variable (and therefore accessible to the template) and then
	 * including the template.
	 * 
	 * @param array $renderArgs the arguments to be passed to the template
	 */
	public function render(array $renderArgs = array())
	{
		// Save data required by template into local variables, which will
		// be accessible by the template (included below)
		extract($renderArgs);
		
		// Render view, based on template
	    include($this->templateFilePath);
	}
}
