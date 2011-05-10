<?php

require_once 'PHPUnit/Framework/TestCase.php';

if (!defined('TEST_INCLUDE_PATH')) {
	set_include_path(get_include_path() . ':../../..');
	define('TEST_INCLUDE_PATH', true);
}

// Include tests
include 'unittests/modules/tasks/model/TaskTest.php';
