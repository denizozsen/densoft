<?php

/**
 * The container for Web-level services, such as the database API.
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
			$this->router = config_Configuration::getInstance()->createWebRouter();
		}
		
		return $this->router;
	}
	
	public function getRequest()
	{
		if (is_null($this->request)) {
			$this->request = config_Configuration::getInstance()->createWebRequest();
		}
		
		return $this->request;
	}
	
	public function getPage()
	{
		if (is_null($this->page)) {
			$this->page = config_Configuration::getInstance()->createWebPage();
		}
		
		return $this->page;
	}
	
	private function __construct()
	{
	}
}
