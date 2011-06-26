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

	public function __construct()
	{
		$this->id           = -1;
		$this->name         = 'Untitled Task';
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
