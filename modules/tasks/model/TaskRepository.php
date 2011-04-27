<?php

/**
 * The repository for Task entities.
 *
 * @author Deniz …zsen
 */
class modules_tasks_model_TaskRepository implements system_core_Repository
{
	public function getByKey($key)
	{
		// TODO - throw a custom exception
		if (!is_int($key) || ($key <= 0)) {
			throw new Exception("Key must be a positive integer, was: {$key}");
		}

		$db = system_core_Application::getInstance()->getDb();
		$taskRow = $db->runSingleRowQuery("
			SELECT id, name, description, creation_date
				FROM task
				WHERE id = {$key}");

		return self::createTaskFromRowArray($taskRow);
	}

	public function getBySpecification($specification)
	{
		// TODO - implement modules_tasks_model_TaskRepository::getBySpecification($specification)
	}

	public function getAll()
	{
		$db = system_core_Application::getInstance()->getDb();
		$taskQueryResult = $db->runQuery("
			SELECT id, name, description, creation_date
				FROM task
				WHERE id = {$key}");

		$allTasks = array();

		while($taskRow = $db->fetchNextArray($taskQueryResult)) {
			$allTasks[] = self::createTaskFromRowArray($taskRow);
		}

		return $allTasks;
	}

	public function add(modules_tasks_model_Task $task)
	{
		$db = system_core_Application::getInstance()->getDb();
		$db->runQuery("
			INSERT INTO task (id, name, description, creation_date)
				VALUES ({$task->getId()}, {$task->getName()}, {$task->getDescription()}, {$task->getCreationDate()})");
	}

	public function saveChanges(modules_tasks_model_Task $task)
	{
		$db = system_core_Application::getInstance()->getDb();
		$db->runQuery("
			UPDATE task
				SET name          = '{$task->getName()}',
					description   = '{$task->getDescription()}',
					creation_date = '{$task->getCreationDate()}'
				WHERE id = {$task->getId()}");
	}

	public function remove(modules_tasks_model_Task $task)
	{
		$this->removeByKey($task->getId());
	}

	public function removeByKey($key)
	{
		$db->runQuery("DELETE FROM task WHERE id = {$key}");
	}

	private static function createTaskFromRowArray($rowArray)
	{
		$task = new self();
		$task->setId($taskId);
		$task->setName($taskRow['name']);
		$task->setDescription($taskRow['description']);
		$task->setCreationDate($taskRow['creation_date']);
		return $task;
	}
}
