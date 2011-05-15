<?php

/**
 * TODO - document class system_web_Request
 * 
 * @author Deniz Ozsen
 */
class system_web_Request
{
	private $handler;
    private $parameters;
	
    // TODO - finish implementation of and test request contributions
    private $contributions;
		
    public function __construct($handler, $parameters, $contributions = array())
    {
        $this->handler    = $handler;
        $this->parameters = $parameters;
		
        $this->contributions = $contributions;
    }
	
    public function getHandler()
    {
        return $this->handler;
    }
	
    public function getParameters()
    {
        return $this->parameters;
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
