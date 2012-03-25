<?php

/**
 * A composite controller is a controller that has any number of children, and
 * whose controller method calls are delegated to each of its children, in the
 * order in which those children were added via addChildController().
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
	
	/**
	 * Adds a controller to the composite's list of child controllers.
	 * 
	 * @param system_mvc_Controller $childController the child controller to add
	 */
	public function addChildController(system_mvc_Controller $childController)
	{
		$this->childControllers[] = $childController;
	}
	
    /* (non-PHPdoc)
     * @see system_mvc_Controller::handleActions()
     */
    public function handleActions()
    {
        foreach($this->childControllers as $child) {
        	$child->handleActions();
        }
    }
	
    /* (non-PHPdoc)
     * @see system_mvc_Controller::render()
     */
    public function render()
    {
        if (count($this->childControllers) == 1) {
            // We will render single-child composites without enclosing the
            // single controller with any other tag
            $this->renderWithPrefixAndSuffix('', '');
        } else {
        	// If there are several children, enclose each child with a div
        	// Note: this also caters for the case where the composite does not
        	//       have any children: in that case, nothing is rendered
            $this->renderWithPrefixAndSuffix('<div>' . PHP_EOL, PHP_EOL . '</div>');
        }
    }
    
    /**
     * Extends the normal rendering process (which renders each child, in turn)
     * by printing a specified prefix before each child's rendering output and
     * a specified suffix after each child's rendering output.
     * 
     * @param string $childPrefix a string to be printed before each child's rendering output
     * @param string $childSuffix a string to be printed after each child's rendering output
     */
    public function renderWithPrefixAndSuffix($childPrefix, $childSuffix)
    {
    	foreach($this->childControllers as $child) {
    		echo $childPrefix;
    		$child->render();
    		echo $childSuffix;
    	}
    }
}
