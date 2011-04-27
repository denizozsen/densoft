<?php

/**
 * TODO - Document class system_core_MasterRepository
 *
 * @author Deniz …zsen
 */
class system_core_MasterRepository
{
	private $repositories;

	public function registerRepository($entityClass, system_core_Repository $repository)
	{
		$this->repositories[$entityClass] = $repository;
	}

	public function getByKey($class, $key)
	{
		$repo = $this->repositories[$class];
		return $repo->getByKey($key);
	}

	public function getBySpecification($class, $specification)
	{
		$repo = $this->repositories[$class];
		return $repo->getBySpecification($specification);
	}

	public function getAll($class)
	{
		$repo = $this->repositories[$class];
		return $repo->getAll();
	}

	public function add($entity)
	{
		$repo = $this->repositories[get_class($entity)];
		$repo->add($entity);
	}

	public function saveChanges($entity)
	{
		$repo = $this->repositories[get_class($entity)];
		$repo->saveChanges($entity);
	}

	public function remove($entity)
	{
		$repo = $this->repositories[get_class($entity)];
		$repo->remove($entity);
	}
	public function removeByKey($class, $key)
	{
		$repo = $this->repositories[$class];
		return $repo->removeByKey($key);
	}
}
