<?php

/**
 * The application performs application initialisation, such as connecting to
 * the database, and holds application state.
 *
 * @author Deniz Ozsen
 */
class system_core_Application
{
	private static $instance;

	private $db;
	private $masterRepository;

	/**
	 * Retrieves the singleton Application instance.
	 * 
	 * Note: <code>getInstance()</code> also performs application-level
	 * initialisation, on the first call. This must be done near the start of
	 * the application entry-point, so that certain inistialisation is done
	 * before executing other code, such as setting the include path.
	 */
	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function getDb()
	{
		if (is_null($this->db)) {
			$config = config_Configuration::getInstance();
			$this->db = new system_core_Database(
				$config->getDbServer(),
				$config->getDbUserName(),
        		$config->getDbPassword(),
        		$config->getDbName());
		}

		return $this->db;
	}

	public function getMasterRepository()
	{
		if (is_null($this->masterRepository)) {
			$this->masterRepository = new system_core_MasterRepository();
		}

		return $this->masterRepository;
	}

	private function __construct()
	{
		$this->initialise();
	}

	private function initialise()
	{
		// Set handlers for uncaught exceptions and for errors
        set_exception_handler('handleUncaughtException');
        set_error_handler('handleError');

		// Get reference to Configuration
        $config = config_Configuration::getInstance();

	    // Set appropriate include path for this instance
        set_include_path($config->getIncludePath());
	}
}

/**
 * Handler for any uncaught exception.
 * Note: This function must be declared in the global scope in order for
 *       to be able to register it with set_exception_handler.
 *
 * @param Exception $exception an exception
 */
function handleUncaughtException($exception)
{
    echo "<p>Uncaught exception: {$exception->getMessage()}</p>";
}

/**
 * TODO - Include all info in thrown exception!
 * Handler for any PHP error.
 *
 * @param unknown_type $errno
 * @param unknown_type $errstr
 * @param unknown_type $errfile
 * @param unknown_type $errline
 * @param unknown_type $errcontext
 */
function handleError($errno, $errstr, $errfile, $errline, $errcontext)
{
	$message =
		"Error in {$errfile} (line {$errline}): {$errstr}";

	throw new Exception($message, $errno);
}
