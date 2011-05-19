<?php

/**
 * Utility functions related to URLs.
 *
 * @author Deniz Ozsen
 */
class system_webutils_Urls
{
	/**
	 * Returns the current request URI, without host name and query string.
	 */
	public static function getCurrentRequestUri()
	{
		$requestUri = $_SERVER['REQUEST_URI'];
		
		// Remove query string, if necessary
		$queryStrPos = strpos($requestUri, '?');
		if (false !== $queryStrPos) {
			$requestUri = substr($requestUri, 0, $queryStrPos);
		}
		
		return $requestUri;
	}
	
	/**
	 * TODO - implement and document system_webutils_Urls::splitUrlPath
	 *
	 * @param unknown_type $urlPath
	 */
	public static function splitUrlPath($urlPath)
	{
	    
	}
}
