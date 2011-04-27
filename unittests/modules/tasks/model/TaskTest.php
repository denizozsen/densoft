<?php

require_once 'PHPUnit/Framework/TestCase.php';

if (!defined('TEST_INCLUDE_PATH')) {
	set_include_path(get_include_path() . ':../../../..');
	define('TEST_INCLUDE_PATH', true);
}
require_once 'modules/tasks/model/Task.php';

class TaskTest extends PHPUnit_Framework_TestCase
{
	public function testGetSetId()
	{
		$id = 1234567;
		$task = new modules_tasks_model_Task();
		$task->setId($id);
		$this->assertEquals($id, $task->getId());
	}

	public function testGetSetName()
	{
		$name = 'Test Name';
		$task = new modules_tasks_model_Task();
		$task->setName($name);
		$this->assertEquals($name, $task->getName());
	}

	public function testGetSetDescription()
	{
		$desc = 'This is a test description';
		$task = new modules_tasks_model_Task();
		$task->setDescription($desc);
		$this->assertEquals($desc, $task->getDescription());
	}
	
	public function testGetSetCreationDate()
	{
		$date = '0000-00-00';
		$task = new modules_tasks_model_Task();
		$task->setCreationDate($date);
		$this->assertEquals($date, $task->getCreationDate());
	}

	public function testRetrieveFromDb_invalidId()
	{

	}

	public function testRetrieveFromDb_nonExistingId()
	{

	}

	public function testRetrieveFromDb_existingId()
	{

	}

	// TODO - more cases for testRetrieveListFromDb
	public function testRetrieveListFromDb()
	{

	}

	public function testRetrieveCountFromDb_emptyTable()
	{
		
	}

	public function testRetrieveCountFromDb_oneEntryInTable()
	{
		
	}

	public function testRetrieveCountFromDb_ninetySixEntriesInTable()
	{
		
	}

	public function runTests()
	{
		$this->testRetrieveFromDb_invalidId();
		$this->testRetrieveFromDb_nonExistingId();
		$this->testRetrieveFromDb_existingId();
		
		$this->testRetrieveListFromDb();

		testRetrieveCountFromDb_emptyTable();
		testRetrieveCountFromDb_oneEntryInTable();
		testRetrieveCountFromDb_ninetySixEntriesInTable();
	}
}
