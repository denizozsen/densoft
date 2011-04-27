<?php

class system_core_Php
{
	public static function getIncludeContents($filename)
	{
	    if (is_file($filename)) {
	        ob_start();
	        include $filename;
	        $contents = ob_get_contents();
	        ob_end_clean();
	        return $contents;
	    }

	    throw new Exception("Include file not found: $filename");
	}
}
