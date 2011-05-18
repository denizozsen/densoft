<?php

/**
 * Services related to routing, such as translation between requests and scripts.
 *
 * @author Deniz �zsen
 */
class system_web_Router
{
	// TODO - should getScriptForRequest throw Exception instead of returning false, if no match found
	
	public function splitRequestPath($urlPath)
	{
		// Break up URL into its elements
		$urlElements = explode('/', $urlPath);
		
		// Eliminate preceding and trailing empty URL elements
		if ( (count($urlElements) != 0) && ('' == $urlElements[0]) ) {
			array_shift($urlElements);
		}
		if ( (count($urlElements) != 0) && ('' == $urlElements[count($urlElements)-1]) ) {
			array_pop($urlElements);
		}
		
		return $urlElements;
	}
	
	public function findHandlerAndUpdateRequest(system_web_Request $request)
	{
		$handler = null;
		
		if ($request->getRawPath() == '/') {
			
			$handler = $this->getDefaultHandler();
			
		} else {
		
			// Find handler class in handlers directory
			$urlElements = $request->getPath();
			$handlerPathCandidate = Configuration::HANDLERS_DIR;
			for($i = 0; $i < count($urlElements); ++$i) {
				$element = $urlElements[$i];
				$handlerPathCandidate .= $element;
				if (is_file("$handlerPathCandidate.php")) {
					require_once("$handlerPathCandidate.php");
					$handlerClassName = $element . 'Handler';
					$handler = new $handlerClassName();
					$request->setPath($handlerPathCandidate);
					$request->setParameters( array_merge(
						array_slice($urlElements, $i+1),
						$request->getParameters()) );
					break;
				}
				$handlerPathCandidate .= '/';
			}
		
		}
						
		$handler->setRequest($request);
		
		return $handler;
	}
	
	private function getDefaultHandler()
	{
		require_once(Configuration::HANDLERS_DIR . 'Default.php');
		$handlerClass = new ReflectionClass('DefaultHandler');
		return $handlerClass->newInstance();
	}
	
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
			return Configuration::HOMEPAGE_SCRIPT_PATH;
		}

		// Obtain first element of request spec
		$firstRequestSpecElement = $requestSpec[0];

		// Check for match in routing configuration
		$requestToScriptTable =
			Configuration::getInstance()->getRequestToScriptTable();
		if (array_key_exists($firstRequestSpecElement, $requestToScriptTable)) {
			return $requestToScriptTable[strtolower($firstRequestSpecElement)];
		}

		// If no match in configuration, check if file exists in pages folder
		$pathInPagesFolder = Configuration::HANDLERS_DIR . "{$firstRequestSpecElement}.php";
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
	public function redirectTo($url)
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
