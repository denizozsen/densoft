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
			$config = Configuration::getInstance();
			$this->db = $config->createCoreDatabase();
			$this->db->connect(
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
			$this->masterRepository =
				Configuration::getInstance()->createCoreMasterRepository();
		}
		
		return $this->masterRepository;
	}
	
	private function __construct()
	{
	}
}
