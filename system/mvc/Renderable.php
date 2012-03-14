<?php

/**
 * A Renderable is an object that can be rendered to the output stream.
 * 
 * @author Deniz Ozsen
 */
interface system_mvc_Renderable
{
	/**
	 * Renders the Renderable.
	 */
	function render();
}
