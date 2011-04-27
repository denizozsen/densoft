<?php

/**
 * Configuration that is specific to the live environment.
 *
 * @author Deniz �zsen
 */
class config_LiveConfiguration extends config_Configuration
{
	const INCLUDE_PATH = '/insert/path/to/docroot/here';
	const ROOT_URL     = '/';
	const DB_SERVER    = '';
	const DB_USERNAME  = '';
	const DB_PASSWORD  = '';
	const DB_NAME      = '';
	
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
