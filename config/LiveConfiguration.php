<?php

/**
 * Configuration that is specific to the live environment.
 *
 * @author Deniz Ozsen
 */
class config_LiveConfiguration extends Configuration
{
	public function rootUrl()
	{
		return '/';
	}
	
	public function dbServer()
	{
		return '';
	}

	public function dbUserName()
	{
		return '';
	}

	public function dbPassword()
	{
		return '';
	}

	public function dbName()
	{
		'';
	}
	
	public function timezone()
	{
	    return 'Europe/London';
	}
}
