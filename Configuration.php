<?php

/**
 * Web Application Configuration.
 *
 * @author Deniz Ozsen
 */
abstract class Configuration
{
	const HANDLERS_DIR         = 'handlers/';
	const ERROR_HANDLER_NAME   = 'Error';
	const HOMEPAGE_SCRIPT_PATH = 'handlers/tasklist.php';
	const SITE_NAME            = 'Home Monitor';
	const THEME_PATH           = 'themes/basic/theme.css';
	const COPANY_LOGO_PATH     = 'themes/basic/company_logo.gif';
	const FOOTER_HTML          = 'Copyright DenSoft (c) 2011';
	
	private static $instance;
	
	private $requestToScriptTable;
	
	/**
	 * Retrieves the configuration appropriate for the current environment,
	 * i.e. for either local, test or live.
	 *
	 * @return Configuration
	 */
	public static function getInstance()
	{
		if (self::$instance == null) {
			throw new Exception(
				'Configuration instance not yet set. Set it using setInstance(...)');
		}
		
		return self::$instance;
	}
	
	/**
	 * Sets the configuration instance to be used in the current environment.
	 *
	 * @param Configuration $instance the configuration instance to be
	 *        used in the current environment
	 */
	public static function setInstance(Configuration $instance)
	{
		self::$instance = $instance;
	}
	
	public function createCoreDatabase()
	{
		return new system_core_Database();
	}
	
	public function createCoreMasterRepository()
	{
		return new system_core_MasterRepository();
	}
	
	public function createWebRouter()
	{
		return new system_web_Router();
	}
	
	public function createWebRequest()
	{
		return new system_web_Request();
	}
	
	public function createWebPage()
	{
		return new system_web_Page();
	}
	
	public abstract function getIncludePath();
	public abstract function getRootUrl();
	public abstract function getDbServer();
	public abstract function getDbUserName();
	public abstract function getDbPassword();
	public abstract function getDbName();
	public abstract function getTimezone();
}
