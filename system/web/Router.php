<?php

/**
 * Services related to routing, such as translation between requests and scripts.
 *
 * @author Deniz …zsen
 */
class system_web_Router
{
    // TODO - make system_web_Router a singleton and let it manage state such as: the current request, (ordered) list of modules participating in requests (they must register themselves somehow)
	// TODO - should getScriptForRequest throw Exception instead of returning false, if no match found

	/**
	 * Returns the script path for the given request path.
	 * @param string $requestPath a request path, excluding http and server name
	 * @return the script path for the given request path, or false, if no
	 *         entry exists for the given request path
	 */
	public static function getScriptForRequest($requestPath)
	{
		// Get individual components of request path
		$requestSpec = self::parseRequestPath($requestPath);

		// Handle home page request (when request spec has no elements)
		if (count($requestSpec) == 0) {
			return config_Configuration::HOMEPAGE_SCRIPT_PATH;
		}

		// Obtain first element of request spec
		$firstRequestSpecElement = $requestSpec[0];

		// Check for match in routing configuration
		$requestToScriptTable =
			config_Configuration::getInstance()->getRequestToScriptTable();
		if (array_key_exists($firstRequestSpecElement, $requestToScriptTable)) {
			return $requestToScriptTable[strtolower($firstRequestSpecElement)];
		}

		// If no match in configuration, check if file exists in pages folder
		$pathInPagesFolder = "pages/{$firstRequestSpecElement}.php";
		if (file_exists($pathInPagesFolder)) {
			return $pathInPagesFolder;
		}

		// If still no match, return false
		return false;
	}

	/**
	 * Redirects to the given URL.
	 * @param string $url the URL to which to redirect.
	 */
	public static function redirectTo($url)
	{
		header("Location: $url");
	}

	/**
	 * Parses the request path and returns the corresponding request
	 * specification.
	 * @param string $requestPath a request path
	 * @return the request specification matching the given request path
	 */
	private static function parseRequestPath($requestPath)
	{
		// Convert request path to lowercase
		$requestPath = strtolower($requestPath);

		// Split up into components
		$requestSpec = explode('/', $requestPath);

		// Remove any empty components (due to preceding/trailing backslashes
		// or double-backslashes)
		$cleanRequestSpec = array();
		foreach($requestSpec as $component) {
			$trimmedComponent = trim($component);
			if ($trimmedComponent != '') {
				$cleanRequestSpec[] = $trimmedComponent;
			}
		}

		return $cleanRequestSpec;
	}
}
