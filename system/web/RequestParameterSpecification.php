<?php

class system_web_RequestParameterSpecification
{
    private static $variableParameterSpecification;

    private $parameterName;
    private $argumentCount;

    public function __construct($parameterName, $argumentCount)
    {
        $this->parameterName = $parameterName;
        $this->argumentCount = $argumentCount;
    }

    public function getParameterName()
    {
        return $this->parameterName;
    }

    public function getArgumentCount()
    {
        return $this->argumentCount;
    }

    public static function variableParameterSpecification()
    {
        if (null == self::$variableParameterSpecification) {
            self::$variableParameterSpecification = new self('__VARIABLEPARAM__', 0);
        }

        return self::$variableParameterSpecification;
    }
}
