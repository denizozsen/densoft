<?php

class templates_SimplePage extends system_web_Page
{
	private $pageHeading = '[page heading]';
	private $content     = '[content]';

	public function __construct()
	{
		parent::__construct('templates/SimplePage_Markup.php');
	}

	public function setPageHeading($pageHeading)
	{
		$this->pageHeading = $pageHeading;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}
}
