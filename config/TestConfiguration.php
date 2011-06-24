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
	
	public function getIncludePath()
	{
		return self::INCLUDE_PATH;
	}

	public function getRootUrl()
	{
		return self::ROOT_URL;
	}
	
	public function getDbServer()
	{
		return self::DB_SERVER;
	}

	public function getDbUserName()
	{
		return self::DB_USERNAME;
	}

	public function getDbPassword()
	{
		return self::DB_PASSWORD;
	}

	public function getDbName()
	{
		return self::DB_NAME;
	}
	
	public function getTimezone()
	{
	    return self::TIMEZONE;
	}
}
