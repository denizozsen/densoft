<?php

// Create and register auto-loader first, to avoid require statements in following code
/**
 * Auto-load handler that expects that class names match the full path of the
 * file in which they are declared, with slashes replaced by underscores, e.g.
 * class system_core_Services is declared in file
 * system/core/Services.php.
 *
 * @param string $className the name of the class to load
 */
function densoft_autoload($className)
{
    // Use pear class naming rule
	$pathToClassFile = str_replace('_', '/', $className) . '.php';

	// First try from root
	if (file_exists($pathToClassFile)) {
		require($pathToClassFile);
		return;
	}
	
	// Then try starting at level of app folder
	$pathToClassFile = 'app/' . $pathToClassFile;
	if(file_exists($pathToClassFile)) {
	    require($pathToClassFile);
		return;
	}
	
	// No class found: throw exception
	throw new system_core_ClassNotFoundException();
}
spl_autoload_register('densoft_autoload');
