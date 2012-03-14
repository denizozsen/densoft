<?php

/**
 * TODO - Implement a proper Controller class
 * TODO - Document this class
 *
 * Enter description here ...
 *
 * @author Deniz Ozsen
 */
class modules_navigation_NavigationLinksController
    extends system_mvc_Controller implements system_web_RequestParticipant
{
    private $request;

    private $model;
    private $view;

    public function __construct($currentRequestPath, system_web_Request $request)
    {
        $this->request = $request;

		// Create model
		$this->model = array();
		$this->model[] = new modules_navigation_model_Link('/', 'Task List', (null == $currentRequestPath));
		$this->model[] = new modules_navigation_model_Link('/task/', 'Create Task', ('task' == $currentRequestPath));
		$this->model[] = new modules_navigation_model_Link('/about/', 'About', ('about' == $currentRequestPath));
		
		// Create view
		$this->view = new modules_navigation_view_NavigationLinksList($this->model);
    }

    public function handleActions()
    {
        // Do nothing, since this module does not handle any actions
    }

    public function render()
    {
		$this->view->render();
    }
}
