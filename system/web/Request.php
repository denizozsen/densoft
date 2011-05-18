<?php

/**
 * The Request object holds the path and arguments that represent the
 * current web request.
 * 
 * @author Deniz Ozsen
 */
class system_web_Request
{
	private $rawPath;
	private $handlerPath;
    private $arguments;
    private $commandArguments;
	
    // TODO - finish implementation of and test request contributions
    private $contributions;
		
    public function __construct()
    {
    	$this->rawPath           = '';
    	$this->handlerPath       = array();
        $this->arguments         = array();
        $this->commandArguments  = array();
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
    
    public function getHandlerPath()
    {
        return $this->handlerPath;
    }
	
    public function setHandlerPath($handlerPath)
    {
    	$this->handlerPath = $handlerPath;
    }
    
    public function getArguments()
    {
        return $this->arguments;
    }
	
    public function setArguments(array $arguments)
    {
    	$this->arguments = $arguments;
    }
    
    public function getCommandArguments()
    {
        return $this->commandArguments;
    }
	
    public function setCommandArguments(array $commandArguments)
    {
    	$this->commandArguments = $commandArguments;
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
