<?php

/**
 * Web Application Configuration.
 *
 * @author Deniz Ozsen
 */
abstract class Configuration
{
	private static $instance;
	
	private $requestToScriptTable;
	
	/**
	 * Retrieves the configuration appropriate for the current environment,
	 * i.e. for either local, test or live.
	 *
	 * @return Configuration
	 */
	public static function instance()
	{
		if (self::$instance == null) {
			throw new Exception(
				'Configuration instance not yet set. Set it using setInstance(...) from within the boostrapper code.');
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
	
	public function handlersPrefix() { return 'handlers'; }

	public function defaultHandlerName() { return 'Default'; }

	public function errorHandlerName() { return 'Error'; }

	public function siteName() { return 'Home Monitor'; }

	public function themePath() { return 'themes/basic/theme.css'; }
	
	public function companyLogoPath() { return 'themes/basic/company_logo.gif'; }

	public function footerHtml() { return 'Copyright DenSoft (c) 2011'; }
		
	// The following settings differ according to environment (local, test, live)
	public abstract function getIncludePath();
	public abstract function getRootUrl();
	public abstract function getDbServer();
	public abstract function getDbUserName();
	public abstract function getDbPassword();
	public abstract function getDbName();
	public abstract function getTimezone();

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
}
