<?php

/**
 * Web Application Configuration.
 *
 * @author Deniz …zsen
 */
abstract class config_Configuration
{	
	const HANDLERS_DIR         = 'handlers/';
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
	
	public static function setInstance(config_Configuration $instance)
	{
		self::$instance = $instance;
	}
	
	public function getRequestToScriptTable()
	{
		if ($this->requestToScriptTable == null) {
			$this->requestToScriptTable = array();
			// Insert any request-to-script mappings here
		}
		
		return $this->requestToScriptTable;
	}
	
	public abstract function getIncludePath();
	public abstract function getRootUrl();
	public abstract function getDbServer();
	public abstract function getDbUserName();
	public abstract function getDbPassword();
	public abstract function getDbName();
}
