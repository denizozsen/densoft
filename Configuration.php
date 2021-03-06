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
				'Configuration instance not yet set. Set it using setInstance(...) in boostrapper code.');
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
	
	public function logoPath() { return 'themes/basic/company_logo.gif'; }

	public function footerHtml() { return 'Copyright DenSoft (c) 2011'; }
		
	// The following settings differ according to environment (local, test, live)
	public abstract function rootUrl();
	public abstract function dbServer();
	public abstract function dbUserName();
	public abstract function dbPassword();
	public abstract function dbName();
	public abstract function timezone();
}
