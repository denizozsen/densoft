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
		if (self::$instance == null) {
			throw new Exception(
				'system_core_Service instance not yet set. Set it using setInstance(...) in boostrapper code.');
		}
		
		return self::$instance;
	}
	
	/**
	 * Sets the system_core_Services instance to be used.
	 *
	 * @param system_core_Services $instance the configuration instance to be
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
