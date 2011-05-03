<?php

/**
 * TODO - document class system_web_WebApplication
 *
 * @author Deniz …zsen
 */
class system_web_WebApplication extends system_core_Application
{
	//protected static $instance;
	
	private $request;
	private $page;

	/**
	 * Retrieves the singleton WebApplication instance.
	 *
	 * Note: <code>getInstance()</code> also performs web-level and
	 * application-level initialisation, on the first call. This must be done
	 * near the start of the web application's entry-point or bootstrapper, so
	 * that certain initialisation (such as setting the include path) is done
	 * before executing other code.
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
		if (is_null($this->request)) {
			$this->request = system_web_Request::createFromCurrentRequest();
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

	protected function __construct()
	{
		parent::__construct();
		$this->initialise();
	}

	private function initialise()
	{
		// TODO - do we need any web-level initialisation??
	}
}
