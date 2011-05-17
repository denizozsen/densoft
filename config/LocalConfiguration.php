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
}
