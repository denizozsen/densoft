<?php

/**
 * Constants that identify the logical areas of a web page.
 */
class system_web_PageArea
{
	const CONTENT      = 0;
	const HEADING      = 1;
	const TOP_BAR      = 2;
	const MAIN_NAV     = 3;
	const LEFT_COLUMN  = 4;
	const RIGHT_COLUMN = 5;
	const FOOTER       = 6;

	// Prevent instantiation
	private function __construct()
	{}
}
