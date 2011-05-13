<?php

/**
 * The View of the MVC (Model-View-Controller) concept.
 *
 * @author Deniz Ozsen
 */
class system_mvc_View
{
	private $templateFile;
	
	public function setTemplate($templateFile)
	{
		$this->templateFile = $templateFile;
	}

	public function getTemplate()
	{
		return $this->templateFile;
	}

	public function render(array $renderArgs = array())
	{
		// Save data required by template into local variables, which will
		// be accessible by the template (included below)
		extract($renderArgs);
		
		// Render view, based on template
	    include($this->templateFile);
	}
}
