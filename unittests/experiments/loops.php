<?php

/////////  Test if array expression is evaluated more than once  /////////

$myArray = array(1, 2, 3, 4, 5);

foreach(getUpdatedArray($myArray) as $myElement) {
	$dummy = getUpdatedArray($myArray);
	echo "element: $myElement\n";
}

function getUpdatedArray($anArray)
{
	// Output array with 10 elements, except for the first
	// time this function is called
	static $ready = false;
	if ($ready) {
		return array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
	}
	$ready = true;
	
	return $anArray;
}

//////////////////////////////////////////////////////////////////////////
