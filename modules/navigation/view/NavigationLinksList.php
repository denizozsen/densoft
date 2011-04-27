<?php

class modules_navigation_view_NavigationLinksList
{
	private $model;

	public function __construct($model)
	{
		foreach($model as $page) {
			if (!($page instanceof modules_navigation_model_Link)) {
				throw new Exception('model element not of type modules_navigation_model_Link');
			}
		}

		$this->model = $model;
	}

	public function render()
	{
		include 'modules/navigation/view/NavigationLinksList_Markup.php';
	}
}
