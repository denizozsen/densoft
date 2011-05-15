<?php

/**
 * The Request object holds the path and parameters that represent the
 * current web request.
 * 
 * @author Deniz Ozsen
 */
class system_web_Request
{
	private $rawPath;
	private $path;
    private $parameters;
    private $commandParameters;
	
    // TODO - finish implementation of and test request contributions
    private $contributions;
		
    public function __construct()
    {
    	$this->rawPath           = '';
    	$this->path              = array();
        $this->parameters        = array();
        $this->commandParameters = array();
        $this->contributions     = array();
    }
	
    public function getRawPath()
    {
        return $this->rawPath;
    }
	
    public function setRawPath($rawPath)
    {
    	$this->rawPath = $rawPath;
    }
    
    public function getPath()
    {
        return $this->path;
    }
	
    public function setPath($path)
    {
    	$this->path = $path;
    }
    
    public function getParameters()
    {
        return $this->parameters;
    }
	
    public function setParameters(array $parameters)
    {
    	$this->parameters = $parameters;
    }
    
    public function getCommandParameters()
    {
        return $this->commandParameters;
    }
	
    public function setCommandParameters(array $commandParameters)
    {
    	$this->commandParameters = $commandParameters;
    }
	
    public function getContributions()
    {
        return $this->contributions;
    }
	
    public function addContribution(system_web_RequestParticipant $contribution)
    {
        $this->contributions[] = $contribution;
    }
}
