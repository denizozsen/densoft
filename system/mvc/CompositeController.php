<?php

/**
 * TODO - Document this class
 *
 * @author Deniz …zsen
 */
class system_mvc_CompositeController extends system_mvc_Controller
{
	private $childControllers;

	/**
	 * Creates a new composite controller, with constructor arguments used
	 * as children.
	 *
	 * @throws InvalidArgumentException if any argument is not of type system_web_Controller
	 */
	public function __construct()
	{
		$this->childControllers = array();

		foreach(func_get_args() as $childController) {
			$this->addChildController($childController);
		}
	}

	public function addChildController($childController)
	{
		$this->childControllers[] = $childController;
	}

    public function handleActions()
    {
        foreach($this->childControllers as $child) {
        	$child->handleActions();
        }
    }

    public function renderView()
    {
        // If we have only one child, render it, otherwise render each
        // child in its own div
        if (count($this->childControllers) == 1) {
            $this->childControllers[0]->renderView();
        } else {
            foreach($this->childControllers as $child) {
            	echo '<div>' . PHP_EOL;
            	$child->renderView();
            	echo '</div>' . PHP_EOL;
            }
        }
    }
}
