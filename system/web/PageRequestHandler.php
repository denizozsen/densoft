<?php

/**
 * A request handler that handles page requests, i.e. requests that expect
 * an HTML document as a response.
 * 
 * @author Deniz Ozsen
 */
abstract class system_web_PageRequestHandler extends system_web_RequestHandler
{
    public function handle()
    {
        // Let handler set up controllers and other page settings
        $this->configurePage(system_web_Services::instance()->getPage());
        
        // Execute any commands issued by the client
        $controllersOnPage =
            system_web_Services::instance()->getPage()->getControllers();
        foreach ($controllersOnPage as $controller) {
        	$controller->handleActions();
        }
        
        // Render the response
        $this->renderResponse();
    }
    
	/**
	 * Called by the framework when it is time to set the Page's attributes,
	 * such as the template to use for rendering, controllers, etc.
	 * 
	 * This method must be implemented by each specific handler.
	 */
	public abstract function configurePage(system_web_Page $page);
    
	/**
	 * Called by the framework when it is time to render the response to be
	 * sent back to the client.
	 * 
	 * This method may be overridden. The base-class implementation of this
	 * method calls render() on the Response object.
	 */
	public function renderResponse()
	{
		system_web_Services::instance()->getPage()->render();
	}
}
