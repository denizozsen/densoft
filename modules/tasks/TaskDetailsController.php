<?php

class modules_tasks_TaskDetailsController extends system_mvc_Controller
{
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
		        $this->model->setId(-1);
		        $this->model->setName('Untitled Task');
		        $this->model->setDescription('');
		        $this->model->setCreationDate(date('d:m:Y'));
		    } else {
    			$this->model =
    				modules_tasks_model_Task::retrieveFromDb($this->getTaskIdFromRequest());
		    }
		    
		}

		return $this->model;
	}
    
    public function handleActions()
    {
        // TODO - implement
    }
    
    public function render(array $renderArgs = array())
    {
//        $this->view->render($renderArgs);
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
            system_web_Services::getInstance()->getRouter()->redirectTo('/');
        }
        
        // Return task id as integer
        return intval($rawTaskId);
    }
}
