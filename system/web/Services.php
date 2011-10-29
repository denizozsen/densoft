<?php

/**
 * The container for Web-level services, such as the Router, Request and
 * Response objects.
 *
 * @author Deniz Ozsen
 */
class system_web_Services
{
	private static $instance;
	
	private $router;
	private $request;
	private $page;
	
	/**
	 * Retrieves the singleton instance.
	 */
	public static function instance()
	{
		if (self::$instance == null) {
			throw new Exception(
				'system_web_Services instance not yet set. Set it using setInstance(...) in boostrapper code.');
		}
		
		return self::$instance;
	}
	
	/**
	 * Sets the system_web_Services instance to be used.
	 *
	 * @param system_web_Services $instance the configuration instance to be
	 *        used
	 */
	public static function setInstance($instance)
	{
	    // Null value means use default instance
	    if (is_null($instance)) {
	        $instance = new self();
	    }
	    
	    self::$instance = $instance;
	}
	
	public function getRouter()
	{
		if (is_null($this->router)) {
			$this->router = new system_web_Router();
		}
		
		return $this->router;
	}
	
	public function getRequest()
	{
		if (is_null($this->request)) {
			$this->request = new system_web_Request();
		}
		
		return $this->request;
	}
	
	public function getPage()
	{
		if (is_null($this->page)) {
			$this->page = new system_web_Page();
		}
		
		return $this->page;
	}
	
	private function __construct()
	{
	}
}
