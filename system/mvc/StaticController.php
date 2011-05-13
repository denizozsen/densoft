<?php

/**
 * A controller that outputs static content and handles no actions.
 *
 * @author Deniz …zsen
 */
class system_mvc_StaticController extends system_mvc_Controller
{
	private $staticContent;

	public function __construct($staticContent)
	{
		$this->staticContent = $staticContent;
	}

    /**
     * Renders the view managed by this controller.
     */
    public function render()
    {
        echo $this->staticContent;
    }
}
