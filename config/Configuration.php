<?php

/**
 * Web Application Configuration.
 *
 * @author Deniz …zsen
 */
abstract class config_Configuration
{
	const URL_PREFIX_LOCAL = 'local';
	const URL_PREFIX_TEST  = 'test';

	const HOMEPAGE_SCRIPT_PATH = 'pages/tasklist.php';
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
		$lowercaseServerName = strtolower($_SERVER['SERVER_NAME']);

		if (self::$instance == null) {
			if (strpos($lowercaseServerName, strtolower(self::URL_PREFIX_LOCAL)) !== false) {
				self::$instance = new config_LocalConfiguration();
			} elseif (strpos($lowercaseServerName, strtolower(self::URL_PREFIX_TEST)) !== false) {
				self::$instance = new config_TestConfiguration();
			} else {
				self::$instance = new config_LiveConfiguration();
			}
		}

		return self::$instance;
	}

	private function __construct()
	{
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
