<?php

/**
 * Configuration that is specific to the local environment.
 *
 * @author Deniz Ozsen
 */
class config_LocalConfiguration extends Configuration
{
	public function rootUrl()
	{
		return '/';
	}
	
	public function dbServer()
	{
		return '127.0.0.1';
	}

	public function dbUserName()
	{
		return 'densoft';
	}

	public function dbPassword()
	{
		return 'densoft___';
	}

	public function dbName()
	{
		return 'densoft';
	}
	
	public function timezone()
	{
	    return 'Indian/Mahe';
	}
}
