<?php

/**
 * A repository provides a way to retrieve and manipulate model entities.
 *
 * @author Deniz …zsen
 */
interface system_core_Repository
{
	function getByKey($key);

	function getBySpecification($specification);

	function getAll();

	function add($entity);

	function saveChanges($entity);

	function remove($entity);
	
	function removeByKey($key);
}
