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
		    	$repo = new modules_tasks_model_TaskRepository();
    			$this->model = $repo->getByKey($this->getTaskIdFromRequest());
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
	        	
	        	$this->validateCreateTaskRequest();
	            $name = $_POST['name'];
	            $description = $_POST['description'];
	            $startDate = $_POST['start_date'];
	        	
	        	$newTask = new modules_tasks_model_Task();
	        	$newTask->setName($name);
	        	$newTask->setDescription($description);
	        	$newTask->setStartDate($startDate);
	        	
	        	$repo = new modules_tasks_model_TaskRepository();
	        	$repo->add($newTask);
	        	
	        	system_web_Services::instance()->getRouter()->redirectTo(
	        		"task/?task_id={$newTask->getId()}");
	        } elseif ('update' == $_POST['command']) {
	            
	        } else {
	            // TODO - log invalid command
	        }
    	}
    }
    
    public function render()
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
        
        $view->model = $this->model;
        $view->render();
    }
    
    private function getTaskIdFromRequest()
    {
        // If task id is not specified, return -1 to  indicate create task form
        if (!isset($_GET['task_id'])) {
            return -1;
        }
        
        // Get task id argument
        // TODO - use the request argument mechanisms of class system_web_Request
        $rawTaskId = $_GET['task_id'];
        
        // If task id argument is not an integer, redirect to home page
        if ((string)(int)$rawTaskId !== $rawTaskId) {
            system_web_Services::instance()->getRouter()->redirectTo('/');
        }
        
        // Return task id as integer
        return intval($rawTaskId);
    }
    
    private function validateCreateTaskRequest()
    {
    	// TODO - implement validateCreateTaskRequest()
    }
}
