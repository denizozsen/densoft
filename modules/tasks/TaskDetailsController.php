<?php

class modules_tasks_TaskDetailsController extends system_web_Controller
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
		if (null == $this->model) {
			$this->model =
				modules_tasks_model_Task::retrieveFromDb($this->getTaskIdFromRequest());
		}

		return $this->model;
	}

    public function handleActions()
    {
        // TODO - implement
    }

    public function renderView()
    {
        // TODO - implement
    }

    private function getTaskIdFromRequest()
    {
        return intval($_GET['task_id']);
    }
}
