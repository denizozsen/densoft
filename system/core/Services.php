<?php

/**
 * The container for Core services, such as the database API.
 *
 * @author Deniz Ozsen
 */
class system_core_Services
{
	protected static $instance;
	
	private $db;
	private $masterRepository;
	
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
	
	public function getDb()
	{
		if (is_null($this->db)) {
			$config = Configuration::instance();
			$this->db = new system_core_Database();
			$this->db->connect(
				$config->dbServer(),
				$config->dbUserName(),
        		$config->dbPassword(),
        		$config->dbName());
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
	
	private function __construct()
	{
	}
}
