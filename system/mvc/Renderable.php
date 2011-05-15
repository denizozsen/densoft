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
	 * 
	 * @param array $renderArgs the arguments passed to the rendering algorithm
	 */
	function render(array $renderArgs = array());
}
