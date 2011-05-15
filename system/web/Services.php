<?php

/**
 * The container for Web-level services, such as the database API.
 *
 * @author Deniz Ozsen
 */
class system_web_Services
{
	private static $instance;
	
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
	
	public function getRequest()
	{
		return $this->request;
	}
	
	public function setRequest(system_web_Request $request)
	{
		$this->request = $request;
	}
	
	public function getPage()
	{
		if (is_null($this->page)) {
			$this->page = new system_web_Page();
		}
		
		return $this->page;
	}
	
	public function setPage(system_web_Page $page)
	{
		$this->page = $page;
	}
	
	private function __construct()
	{
	}
}
