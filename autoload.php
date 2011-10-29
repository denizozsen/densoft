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
	$pathToClassFile = str_replace('_', '/', $className) . '.php';
	if (file_exists($pathToClassFile)) {
		require($pathToClassFile);
	} else {
		throw new system_core_ClassNotFoundException();
	}
}
spl_autoload_register('densoft_autoload');
