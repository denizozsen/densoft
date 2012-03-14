<?php

/**
 * Constants that identify the logical regions of a web page.
 */
class system_web_PageRegion
{
	const CONTENT      = 0;
	const HEADING      = 1;
	const SITE_LOGO    = 2;
	const TOP_BAR      = 3;
	const BREAD_CRUMBS = 4;
	const MAIN_NAV     = 5;
	const LEFT_COLUMN  = 6;
	const RIGHT_COLUMN = 7;
	const FOOTER       = 8;

	// Prevent instantiation
	private function __construct()
	{}
}
