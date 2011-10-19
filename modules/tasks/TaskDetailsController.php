<?php

class modules_tasks_TaskDetailsController extends system_mvc_Controller
{
    const MODE_VIEW   = 1;
    const MODE_CREATE = 2;
    const MODE_EDIT   = 3;
    
    private $request;
    
	private $model;
	private $view; // TODO - do we really need to store the view as a member?
    
    public function __construct(system_web_Request $request)
    {
        $this->request = $request;
    }
    
	public function getModel()
	{
	    // Lazy-load model
		if (null == $this->model) {
		    
		    // Get task id argument from request
		    $taskId = $this->getTaskIdFromRequest();
		    
		    // Task id -1 means 'new task', otherwise get from db
		    if (-1 == $taskId) {
		        $this->model = new modules_tasks_model_Task();
		    } else {
    			$this->model =
    				modules_tasks_model_Task::retrieveFromDb($this->getTaskIdFromRequest());
		    }
		    
		}

		return $this->model;
	}
    
	public function getMode()
	{
	    // Get task id argument from request
	    $taskId = $this->getTaskIdFromRequest();
	    
	    // Task id -1 means 'new task'
	    if (-1 == $taskId) {
	        return self::MODE_CREATE;
	    } else {
	        if (isset($_GET['edit'])) {
	            return self::MODE_EDIT;
	        } else {
	            return self::MODE_VIEW;
	        }
	    }
	}
	
    public function handleActions()
    {
    	if (isset($_POST['command'])) {
	        if ('create' == $_POST['command']) {
	            modules_tasks_model_Task::insertToDb(
	                $_POST['name'], $_POST['description'], $_POST['start_date']);
	        } elseif ('update' == $_POST['command']) {
	            modules_tasks_model_Task::updateDb(
	                $_POST['id'], $_POST['name'], $_POST['description'], $_POST['start_date']);
	        } else {
	            // TODO - log invalid command
	        }
    	}
    }
    
    public function render(array $renderArgs = array())
    {
        $view = new system_mvc_View();
        
        $mode = $this->getMode();
        switch($mode) {
            case self::MODE_VIEW:
            $view->setTemplate('modules/tasks/view/ViewTask.tpl');
            break;
            case self::MODE_CREATE:
            $view->setTemplate('modules/tasks/view/CreateTask.tpl');
            break;
            case self::MODE_EDIT:
            $view->setTemplate('modules/tasks/view/EditTask.tpl');
            break;
        }
        
        $renderArgs['model'] = $this->model;
        $view->render($renderArgs);
    }
    
    private function getTaskIdFromRequest()
    {
        // If task id is not specified, return -1 to  indicate create task form
        if (!isset($_GET['id'])) {
            return -1;
        }
        
        // Get task id argument
        // TODO - use the request argument mechanisms of class system_web_Request
        $rawTaskId = $_GET['id'];
        
        // If task id argument is not an integer, redirect to home page
        if ((string)(int)$rawTaskId !== $rawTaskId) {
            system_web_Services::getInstance()->getRouter()->redirectTo('/');
        }
        
        // Return task id as integer
        return intval($rawTaskId);
    }
}
