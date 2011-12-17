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
			system_core_Services::instance()->getDb()->runSingleRowQuery("
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
		$db = system_core_Services::instance()->getDb();
		
		$taskQueryResult = $db->runQuery("
			SELECT id, name, description, start_date
				FROM task");
		
		$allTasks = array();
		
		$taskRow = $db->fetchNextArray($taskQueryResult);
		while(false !== $taskRow) {
			$allTasks[] = self::createTaskFromRecord($taskRow);
			$taskRow = $db->fetchNextArray($taskQueryResult);
		}
		
		return $allTasks;
	}
	
	public function add($task)
	{
		system_core_Services::instance()->getDb()->runQuery("
			INSERT INTO task (name, description, start_date)
				VALUES ('{$task->getName()}', '{$task->getDescription()}', '{$task->getStartDate()}')");
		$task->setId(system_core_Services::instance()->getDb()->lastInsertId());
	}
	
	public function saveChanges($task)
	{
		system_core_Services::instance()->getDb()->runQuery("
			UPDATE task
				SET name          = '{$task->getName()}',
					description   = '{$task->getDescription()}',
					start_date = '{$task->getStartDate()}'
				WHERE id = {$task->getId()}");
	}
	
	public function remove($task)
	{
		$this->removeByKey($task->getId());
	}
	
	public function removeByKey($key)
	{
		system_core_Services::instance()->getDb()
			->runQuery("DELETE FROM task WHERE id = {$key}");
	}
	
	private static function createTaskFromRecord($record)
	{
		$task = new modules_tasks_model_Task();
		$task->setId($record['id']);
		$task->setName($record['name']);
		$task->setDescription($record['description']);
		$task->setStartDate($record['start_date']);
		return $task;
	}
}
