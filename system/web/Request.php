<?php

class system_web_Request
{
    private $page;
    private $parameters;

    private $contributions;

    public static function createFromCurrentRequest()
    {
        $page = ''; // TODO - parse page from request URL
        $parameters = array(); // TODO - parse parameters from request URL
        return new self($page, $parameters);
    }

    private function __construct($page, $parameters, $contributions = array())
    {
        $this->page       = $page;
        $this->parameters = $parameters;

        $this->contributions = $contributions;
    }

    public function getPage()
    {
        return $this->page;
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
