<?php

/**
 * Services related to routing, such as translation between requests and scripts.
 *
 * @author Deniz Ozsen
 */
class system_web_Router
{
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
		
		// Handle root path
		if ($request->getRawPath() == '/') {
			$handler = $this->getDefaultHandler();
		}
		
		// Handle non-root path
		else {
			// Find handler class in handlers directory
			$handlerPathElements = $request->getHandlerPath();
			$handlerPathCandidate = Configuration::instance()->handlersPrefix() . '/';
			$handlerClassNameCandidate = Configuration::instance()->handlersPrefix();
			
			for($i = 0; $i < count($handlerPathElements); ++$i) {
				
				$element = ucfirst(strtolower($handlerPathElements[$i]));
				$handlerPathCandidate = strtolower($handlerPathCandidate) . $element;
				$handlerClassNameCandidate = strtolower($handlerClassNameCandidate) . '_' . $element;
				if (is_file("{$handlerPathCandidate}.php")) {
					//$handlerClassName = "handlers_{$element}";
					$handler = new $handlerClassNameCandidate();
					$request->setHandlerPath($handlerPathCandidate);
					$request->setArguments( array_merge(
						array_slice($handlerPathElements, $i+1),
						$request->getArguments()) );
					break;
				}
				$handlerPathCandidate .= '/';
				
			}
		}
		
		// Handle case where no appropriate handler is found => 404
        if (null == $handler) {
            $handler = $this->getErrorHandler();
        }
		
        // Pass request object to handler
		$handler->setRequest($request);
		
		return $handler;
	}
	
	private function getDefaultHandler()
	{
		$handlerClassName = 'handlers_' . Configuration::instance()->defaultHandlerName();
		return new $handlerClassName();
	}
	
	private function getErrorHandler()
	{
		$handlerClassName = 'handlers_' . Configuration::instance()->errorHandlerName();
		return new $handlerClassName();
	}
	
	/**
	 * Redirects to the given URL (note: script execution stops immediately).
	 * @param string $url the HTTP-encoded URL to which to redirect.
	 */
	public function redirectTo($url)
	{
		header("Location: $url");
		exit();
	}
}
