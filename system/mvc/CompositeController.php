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
			// Ensure argument is a controller
			if (!($childController instanceof system_mvc_Controller)) {
				$actualType = get_class($childController)
					? get_class($childController) : gettype($childController);
				throw new InvalidArgumentException(
					"Expected argument of type system_mvc_Controller, but was: {$actualType}");
			}
			
			// Add argument to list of child controllers
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
	
    public function render(array $renderArgs = array())
    {
        switch(count($this->childControllers))
        {
        	case 0: // if no children, do not render anything
        		break;
        	case 1: // if one child, render it, without enclosing it with any other tag
            	$this->childControllers[0]->render();
        		break;
        	default: // if multiple children, enclose each child with a div
            	foreach($this->childControllers as $child) {
            		echo '<div>' . PHP_EOL;
            		$child->render();
            		echo '</div>' . PHP_EOL;
            	}
        		break;
        }
    }
}
