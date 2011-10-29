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
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
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
