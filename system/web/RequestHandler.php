<?php

/**
 * The role of a request handler is to react to web requests, sent by clients.
 * This class is meant to be sub-classed. Each sub-class handles a different
 * request, e.g.
 * 
 * - The AboutHandler handles requests for the 'About' page.
 * - The SearchHandler handles search requests.
 * - The ContactHandler handles request for the 'Contact Us' page.
 * - etc.
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
	 * The first method to be called by the framework on receiving a request.
	 * 
	 * This method must be implemented by each specific handler.
	 */
	public abstract function init();
	
	/**
	 * Called by the framework when it is time to set the Page's attributes,
	 * such as the template to use for rendering, controllers, etc.
	 * 
	 * This method must be implemented by each specific handler.
	 */
	public abstract function configurePage(system_web_Page $page);
    
	/**
	 * Called by the framework when it is time to execute commands sent by
	 * the client.
	 * 
	 * This method may be overridden. The base-class implementation of this
	 * method calls executeCommands() on each controller set on the Response's
	 * Page object.
	 */
	public function executeCommands()
	{
		$controllersOnPage =
			system_web_Services::getInstance()->getPage()->getControllers();
		foreach ($controllersOnPage as $controller) {
			$controller->handleActions();
		}
	}
	
	/**
	 * Called by the framework when it is time to render the response to be
	 * sent back to the client.
	 * 
	 * This method may be overridden. The base-class implementation of this
	 * method calls render() on the Response object.
	 */
	public function renderResponse()
	{
		system_web_Services::getInstance()->getPage()->render();
	}
}
