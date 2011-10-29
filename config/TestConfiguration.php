<?php

/**
 * Configuration that is specific to the test environment.
 *
 * @author Deniz Ozsen
 */
class config_TestConfiguration extends Configuration
{
	public function includePath()
	{
		return '/sharedfiles/sites/test.densoft.mu';
	}

	public function rootUrl()
	{
		return '/';
	}
	
	public function dbServer()
	{
		return 'localhost';
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
	    return 'Europe/London';
	}
}
