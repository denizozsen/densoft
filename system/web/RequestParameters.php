<?php

/**
 * Object that encapsulates the parameters passed on with a web request, where
 * each parameter consists of a name and a value.
 * 
 * @author deniz
 */
class system_web_RequestParameters
{
    private $parameters;
    
    public function __construct()
    {
        $this->parameters = array();
    }
    
    public function addParameter($name, $value)
    {
        if (is_null($name) || ('' == $name)
                || is_null($value) || ('' == $value)) {
            throw new Exception('name and value arguments must be non-null');
        }
        
        if (array_key_exists($name, $this->parameters)) {
            throw new Exception("Parameter already added: {$name}");
        }
        
        $this->parameters[$name] = $value;
    }
    
    /**
     * Generates and returns the querystring corresponding to the parameters
     * stored by this RequestParameters object, where the list of parameters
     * may be manipulated by the optional optons argument
     * 
     * @param array $options
     */
    public function generateQueryString(array $options = array())
    {   
        // Get final list of parameters
        $params = $this->manipulateParameters($this->parameters, $options);
        
        // Return empty string, if there are no parameters to output
        if (count($params) == 0) {
            return '';
        }
        
        // Format each parameter as name=value
        $formattedParams = array();
        foreach($params as $name => $value) {
            $formattedParams[] = "{$name}={$value}";
        }
        
        // Separate formatted parameters with ampersand and prepend a question mark
        return '?' . implode('&', $formattedParams);
    }
    
    /**
     * Generates and returns input element HTML markup, of type 'hidden',
     * corresponding to the parameters stored by this RequestParameters object,
     * where the list of parameters may be manipulated by the optional optons
     * argument.
     * 
     * @param array $options
     */
    public function generateHiddenInputMarkup(array $options = array())
    {
        // Get final list of parameters
        $params = $this->manipulateParameters($this->parameters, $options);
                
        // Add input element for each parameter
        $result = '';
        foreach($params as $name => $value) {
            $result .= "<input type='hidden' id='{$name}' name='{$name}' value='{$value}'></input>" . PHP_EOL;
        }
        
        return $result;
    }
    
    // TODO - implement manipulateParameters
    private function manipulateParameters(array $storedParams, array $options)
    {
        return $storedParams;
    }
}
