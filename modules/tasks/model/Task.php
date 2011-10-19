<?php

/**
 * TODO - Document this class
 *
 * @author Deniz …zsen
 */
class modules_tasks_model_Task
{
	private $id;
	private $name;
	private $description;
	private $startDate;
    
	public static function retrieveCountFromDb()
	{
		return system_core_Services::getInstance()->getDb()
			->runSingleValueQuery('SELECT COUNT(1) FROM task');
	}
    
	public static function retrieveFromDb($id)
	{
		$row = system_core_Services::getInstance()->getDb()->runSingleRowQuery("
				SELECT id, name, description, start_date
					FROM task WHERE id = {$id}");
		
		$newTask = new self();
		$newTask->setId($row['id']);
		$newTask->setName($row['name']);
        $newTask->setDescription($row['description']);
		$newTask->setStartDate($row['start_date']);
		
		return $newTask;
	}
    
	public static function insertToDb($name, $description, $startDate)
	{
	    system_core_Services::getInstance()->getDb()->runQuery(
	        "INSERT INTO task(name, description, start_date)
	        	VALUES({$name}, {$description}, {$startDate})");
	}
	
	public static function updateDb($id, $name, $description, $startDate)
	{
	    system_core_Services::getInstance()->getDb()->runQuery(
	        "UPDATE 
	        	SET name        = '{$name}',
	        		description = '{$description}',
	        		start_date  = '{$startDate}'
	        	WHERE id = {$id}");
	}
	
	public function __construct()
	{
		$this->id           = -1;
		$this->name         = 'Untitled';
		$this->description  = '';
		$this->startDate    = date('d:m:Y');
	}
    
	public function getId()
	{
		return $this->id;
	}
    
	public function setId($id)
	{
		$this->id = $id;
	}
    
	public function getName()
	{
		return $this->name;
	}
    
	public function setName($name)
	{
		$this->name = $name;
	}
    
	public function getDescription()
	{
		return $this->description;
	}
    
	public function setDescription($description)
	{
		$this->description = $description;
	}
    
	public function getStartDate()
	{
		return $this->startDate;
	}
    
	public function setStartDate($startDate)
	{
		$this->startDate = $startDate;
	}
}
