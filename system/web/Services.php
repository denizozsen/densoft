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
	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}
	
	public function getRouter()
	{
		if (is_null($this->router)) {
			$this->router = Configuration::instance()->createWebRouter();
		}
		
		return $this->router;
	}
	
	public function getRequest()
	{
		if (is_null($this->request)) {
			$this->request = Configuration::instance()->createWebRequest();
		}
		
		return $this->request;
	}
	
	public function getPage()
	{
		if (is_null($this->page)) {
			$this->page = Configuration::instance()->createWebPage();
		}
		
		return $this->page;
	}
	
	private function __construct()
	{
	}
}
