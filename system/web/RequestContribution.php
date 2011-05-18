<?php


// TODO - Replace classes RequestContribution and RequestParameterSpecification with interface IRequestArgumentConfiguration

class system_web_RequestContribution
{
    private $participant;
    private $parameterSpecifications;

    public function __construct(system_mvc_RequestParticipant $participant,
                                $parameterSpecifications)
    {
        $this->participant             = $participant;
        $this->parameterSpecifications = $parameterSpecifications;
    }

    public function getParticipant()
    {
        return $this->participant;
    }

    public function getParameterSpecifications()
    {
        return $this->parameterSpecifications;
    }
}
