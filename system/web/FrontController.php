<?php

/**
 * TODO - document class system_web_FrontController
 *
 * @author studio
 */
abstract class system_web_FrontController
{
    private $request;
    
    public function __construct(system_web_Request $request)
	{
        $this->request = $request;
	}
    
	public final function getRequest()
	{
	    return $this->request;
	}
    
	/**
	 * Called by framework when it is time to add controllers to the
	 * current request's page.
	 *
	 * This method is meant to be overridden. The base-class implementation
	 * of this method does not do anything.
	 */
	protected function addControllers()
	{

	}
    
	protected function preHandleActions()
	{

	}
    
	protected function postHandleActions()
	{

	}
    
	protected function preRender()
	{

	}
    
	protected function postRender($html)
	{

	}
}
