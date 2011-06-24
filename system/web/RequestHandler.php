<?php

/**
 * The role of a request handler is to react to web requests, sent by clients.
 * This class is meant to be sub-classed. Each sub-class handles a different
 * request.
 * 
 * @author Deniz Ozsen
 */
abstract class system_web_RequestHandler
{
    private $request;
    
	/**
	 * Returns the Request that is handled by the Handler.
	 * 
	 * This method cannot be overwridden.
	 * 
	 * @return the Request that is handled by the Handler
	 */
    public final function getRequest()
	{
	    return $this->request;
	}
	
	/**
	 * Sets the Request that is handled by the Handler.
	 * 
	 * This method cannot be overwridden.
	 * 
	 * @param system_web_Request $request the Request to be handled
	 */
	public final function setRequest(system_web_Request $request)
	{
        $this->request = $request;
	}
	
	/**
	 * The method that is called to let this handler handle the request.
	 * 
	 * This method must be implemented by each specific handler.
	 */
	public abstract function handle();
}
