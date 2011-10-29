<?php

/**
 * Configuration that is specific to the live environment.
 *
 * @author Deniz Ozsen
 */
class config_LiveConfiguration extends Configuration
{
	const INCLUDE_PATH = '/insert/path/to/docroot/here';
	const ROOT_URL     = '/';
	const DB_SERVER    = '';
	const DB_USERNAME  = '';
	const DB_PASSWORD  = '';
	const DB_NAME      = '';
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
