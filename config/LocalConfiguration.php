<?php

/**
 * Configuration that is specific to the local environment.
 *
 * @author Deniz Ozsen
 */
class config_LocalConfiguration extends Configuration
{
	const INCLUDE_PATH = '/Shared/sites/densoft';
	const ROOT_URL     = '/';
	const DB_SERVER    = '127.0.0.1';
	const DB_USERNAME  = 'homemon';
	const DB_PASSWORD  = 'R666Xing';
	const DB_NAME      = 'homemon';
	const TIMEZONE     = 'Indian/Mahe';

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
