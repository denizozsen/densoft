<?php

/**
 * Configuration that is specific to the test environment.
 *
 * @author Deniz Ozsen
 */
class config_TestConfiguration extends Configuration
{
	const INCLUDE_PATH = '/sharedfiles/sites/test.densoft.mu';
	const ROOT_URL     = '/';
	const DB_SERVER    = 'localhost';
	const DB_USERNAME  = 'homemon';
	const DB_PASSWORD  = 'R666Xing';
	const DB_NAME      = 'homemon';
	const TIMEZONE     = 'Europe/London';
	
	public function includePath()
	{
		return self::INCLUDE_PATH;
	}

	public function rootUrl()
	{
		return self::ROOT_URL;
	}
	
	public function dbServer()
	{
		return self::DB_SERVER;
	}

	public function dbUserName()
	{
		return self::DB_USERNAME;
	}

	public function dbPassword()
	{
		return self::DB_PASSWORD;
	}

	public function dbName()
	{
		return self::DB_NAME;
	}
	
	public function timezone()
	{
	    return self::TIMEZONE;
	}
}
