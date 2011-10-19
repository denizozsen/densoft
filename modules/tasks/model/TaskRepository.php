<?php

// TODO - implement input sanitisation in class modules_tasks_model_TaskRepository

/**
 * The repository for Task entities.
 *
 * @author Deniz Ozsen
 */
class modules_tasks_model_TaskRepository implements system_core_Repository
{
	public function getByKey($key)
	{
		// TODO - throw a custom exception
		if (!is_int($key) || ($key <= 0)) {
			throw new Exception("Key must be a positive integer, was: {$key}");
		}

		$taskRow =
			system_core_Services::getInstance()->getDb()->runSingleRowQuery("
			SELECT id, name, description, start_date
				FROM task
				WHERE id = {$key}");

		return self::createTaskFromRecord($taskRow);
	}
	
	public function getBySpecification($specification)
	{
		// TODO - implement modules_tasks_model_TaskRepository::getBySpecification($specification)
	}
	
	public function getAll()
	{
		$db = system_core_Services::getInstance()->getDb();
		
		$taskQueryResult = $db->runQuery("
			SELECT id, name, description, start_date
				FROM task
				WHERE id = {$key}");
		
		$allTasks = array();
		
		while($taskRow = $db->fetchNextArray($taskQueryResult)) {
			$allTasks[] = self::createTaskFromRecord($taskRow);
		}
		
		return $allTasks;
	}
	
	public function add(modules_tasks_model_Task $task)
	{
		system_core_Services::getInstance()->getDb()->runQuery("
			INSERT INTO task (id, name, description, start_date)
				VALUES ({$task->getId()}, {$task->getName()}, {$task->getDescription()}, {$task->getCreationDate()})");
	}

	public function saveChanges(modules_tasks_model_Task $task)
	{
		system_core_Services::getInstance()->getDb()->runQuery("
			UPDATE task
				SET name          = '{$task->getName()}',
					description   = '{$task->getDescription()}',
					start_date = '{$task->getStartDate()}'
				WHERE id = {$task->getId()}");
	}

	public function remove(modules_tasks_model_Task $task)
	{
		$this->removeByKey($task->getId());
	}

	public function removeByKey($key)
	{
		system_core_Services::getInstance()->getDb()
			->runQuery("DELETE FROM task WHERE id = {$key}");
	}

	private static function createTaskFromRecord($record)
	{
		$task = new self();
		$task->setId($record['id']);
		$task->setName($record['name']);
		$task->setDescription($record['description']);
		$task->setCreationDate($record['start_date']);
		return $task;
	}
}
