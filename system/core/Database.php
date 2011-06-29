<?php

/**
 * Utility functions for database operations.
 *
 * @author Deniz Ozsen
 */
class system_core_Database
{
	private $linkId;
	
	public function connect($server, $username, $password, $dbName)
	{
		if (!is_null($this->linkId)) {
			throw new system_core_DatabaseException('Already connected');
		}
		
		// Connect to database; throw exception on error
		try {
			$linkId = mysql_connect($server, $username, $password);
		} catch(Exception $exc) {
			throw new system_core_DatabaseException(
				sprintf('Unable to connect to database. MySQL error: %s',
					mysql_error()), mysql_errno());
		}
		
		// If mysql_connect does not return a link id, it's an error 
		if ($linkId === false) {
			throw new system_core_DatabaseException(
				sprintf('MySQL error: %s', mysql_error()), mysql_errno());
		}
		
		// Store link id for database connection
		$this->linkId = $linkId;
		
		// Select database
		mysql_select_db($dbName, $this->linkId);
	}
	
	public function runQuery($query)
	{
		return mysql_query($query, $this->linkId);
	}
	
	public function numRows($queryResult)
	{
		return mysql_num_rows($queryResult);
	}
	
	public function fetchNextArray($queryResult)
	{
		return mysql_fetch_assoc($queryResult);
	}
	
	public function runSingleValueQuery($query)
	{
		$result = mysql_query($query, $this->linkId);
		$row = mysql_fetch_row($result);
		return $row[0];
	}
	
	public function runSingleRowQuery($query)
	{
		$result = mysql_query($query, $this->linkId);
		return mysql_fetch_assoc($result);
	}
	
	public function runQueryAndReturnAllRows($query)
	{
		$result = $this->runQuery($query);
		if (mysql_errno()) {
			throw new system_core_DatabaseException(sprintf('MySQL error: %s', mysql_error()), mysql_errno());
		}
		
		$rows = array();
		while($row = $this->fetchNextArray($result)) {
			$rows[] = $row;
		}
		
		return $rows;
	}
}
