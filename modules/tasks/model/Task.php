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
	private $creationDate;

	public static function retrieveCountFromDb()
	{
		return system_core_Application::getInstance()->getDb()
			->runSingleValueQuery('SELECT COUNT(1) FROM task');
	}

	public function __construct()
	{
		$this->id           = -1;
		$this->name         = 'Untitled Task';
		$this->creationDate = time();
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

	public function getCreationDate()
	{
		return $this->creationDate;
	}

	public function setCreationDate($creationDate)
	{
		$this->creationDate = $creationDate;
	}
}
