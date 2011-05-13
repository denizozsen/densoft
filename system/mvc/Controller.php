<?php

/**
 * The base class for all controllers.
 *
 * @author studio
 */
abstract class system_mvc_Controller
{
    /**
     * Handles any action that has been performed, relevant to this
     * controller.
     */
    public function handleActions()
    {
        // default behaviour: do nothing
    }

    /**
     * Renders the view(s) managed by this controller.
     */
    public function render()
    {
        // default behaviour: render nothing
    }
}
