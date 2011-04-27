<?php

/**
 * Utility functions for database operations.
 *
 * @author Deniz …zsen
 */
class system_core_Database
{
	private $linkId;

	public function __construct($server, $username, $password, $dbName)
	{
		$this->connect($server, $username, $password, $dbName);
	}

	private function connect($server, $username, $password, $dbName)
	{
		// Connect to database; throw exception on error
		$linkId = mysql_connect($server, $username, $password);
		if ($linkId === false) {
			throw new system_core_DatabaseException(sprintf('MySQL error: %s', mysql_error()), mysql_errno());
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
