<?php

/**
 * The application-level container for fundamental objects, such as the database
 * API, and performs application-level initialisation.
 *
 * @author Deniz Ozsen
 */
class system_core_Application
{
	protected static $instance;

	private $db;
	private $masterRepository;

	/**
	 * Retrieves the singleton Application instance.
	 * 
	 * Note: <code>getInstance()</code> also performs application-level
	 * initialisation, on the first call. This must be done near the start of
	 * the application entry-point, so that certain initialisation (such as
	 * setting the include path) is done before executing other code.
	 */
	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function getDb()
	{
		if (is_null($this->db)) {
			$config = config_Configuration::getInstance();
			$this->db = new system_core_Database(
				$config->getDbServer(),
				$config->getDbUserName(),
        		$config->getDbPassword(),
        		$config->getDbName());
		}

		return $this->db;
	}

	public function getMasterRepository()
	{
		if (is_null($this->masterRepository)) {
			$this->masterRepository = new system_core_MasterRepository();
		}

		return $this->masterRepository;
	}

	protected function __construct()
	{
	}
}
