<?php

require_once 'system/web/RequestParameters.php';
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * system_web_RequestParameters test case.
 */
class unittests_system_web_RequestParametersTest extends PHPUnit_Framework_TestCase
{
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        parent::tearDown();
    }
    
    public function test__construct_doesNotThrow()
    {
        new system_web_RequestParameters();
    }
    
    public function testAddParameter_doesNotThrow()
    {
        $requestParams = new system_web_RequestParameters();
        $requestParams->addParameter('myname', 'myvalue');
    }
    
    /**
     * @expectedException Exception
     */
    public function testAddParameter_throws_onEmptyName()
    {
        $requestParams = new system_web_RequestParameters();
        $requestParams->addParameter('', 'myvalue');
    }
    
    /**
     * @expectedException Exception
     */
    public function testAddParameter_throws_onNullName()
    {
        $requestParams = new system_web_RequestParameters();
        $requestParams->addParameter(null, 'myvalue');
    }
    
    /**
     * @expectedException Exception
     */
    public function testAddParameter_throws_onEmptyValue()
    {
        $requestParams = new system_web_RequestParameters();
        $requestParams->addParameter('myname', '');
    }
    
    /**
     * @expectedException Exception
     */
    public function testAddParameter_throws_onNullValue()
    {
        $requestParams = new system_web_RequestParameters();
        $requestParams->addParameter('myname', null);
    }
    
    /**
     * @expectedException Exception
     */
    public function testAddParameter_throws_onRepeatedValue()
    {
        $requestParams = new system_web_RequestParameters();
        $requestParams->addParameter('myname', 'myvalue');
        $requestParams->addParameter('myname', 'myvalue');
    }
    
    public function testGenerateQueryString_emptyString_forNoParams()
    {
        $requestParams = new system_web_RequestParameters();
        $this->assertEquals('', $requestParams->generateQueryString());
    }
    
    public function testGenerateQueryString_correct_forOneParam()
    {
        $name = 'myname';
        $value = 'myvalue';        
        $requestParams = new system_web_RequestParameters();
        $requestParams->addParameter($name, $value);
        $this->assertEquals(
            $this->createQueryString(array($name => $value)),
            $requestParams->generateQueryString());
    }
    
    public function testGenerateQueryString_correct_forSeveralParams()
    {
        $nameValuePairs = array(
        	'myname1' => 'myvalue1',
            'myname2' => 'myvalue2',
            'myname3' => 'myvalue3',
            'myname4' => 'myvalue4'
        );    
        
        $requestParams = new system_web_RequestParameters();
        foreach($nameValuePairs as $name => $value) {
            $requestParams->addParameter($name, $value);
        }
        
        $this->assertEquals(
            $this->createQueryString($nameValuePairs),
            $requestParams->generateQueryString());
    }
        
    public function testGenerateHiddenInputMarkup_emptyString_forNoParams()
    {
        $requestParams = new system_web_RequestParameters();
        $this->assertEquals('', $requestParams->generateHiddenInputMarkup());
    }
    
    // TODO - parse XML to test return value of generateHiddenInputMarkup, to ignore order of attributes

    public function testGenerateHiddenInputMarkup_correct_forOneParam()
    {
        $name = 'myname';
        $value = 'myvalue';        
        $requestParams = new system_web_RequestParameters();
        $requestParams->addParameter($name, $value);
        
        $result = $requestParams->generateHiddenInputMarkup();
        $result = preg_replace('/\s\s+/', ' ', $result);
        $result = str_replace(array(PHP_EOL, "\r", "\n", "\r"), '', $result);
        
        $this->assertEquals(
            $this->createHiddenInputMarkup(array($name => $value)),
            $result);
    }
    
    public function testGenerateHiddenInputMarkup_correct_forSeveralParams()
    {
        $nameValuePairs = array(
        	'myname1' => 'myvalue1',
            'myname2' => 'myvalue2',
            'myname3' => 'myvalue3',
            'myname4' => 'myvalue4'
        );    
        
        $requestParams = new system_web_RequestParameters();
        foreach($nameValuePairs as $name => $value) {
            $requestParams->addParameter($name, $value);
        }
                
        $result = $requestParams->generateHiddenInputMarkup();
        $result = preg_replace('/\s\s+/', ' ', $result);
        $result = str_replace(array(PHP_EOL, "\r", "\n", "\r"), '', $result);
        
        $this->assertEquals(
            $this->createHiddenInputMarkup($nameValuePairs),
            $result);
    }
    
///////////////////////////////////////////////////

// Helpers

    private function createQueryString($nameValuePairs)
    {
        $queryString = '?';
        foreach($nameValuePairs as $name => $value) {
            $queryString.= "{$name}={$value}&";
        }
        return substr($queryString, 0, strlen($queryString)-1);
    }
    
    private function createHiddenInputMarkup($nameValuePairs)
    {
        $markup = '';
        foreach($nameValuePairs as $name => $value) {
            $markup .= "<input type='hidden' id='{$name}' name='{$name}' value='{$value}'></input>";
        }
        return $markup;
    }
}
