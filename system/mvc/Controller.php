<?php

/**
 * The base class for all controllers.
 *
 * @author studio
 */
abstract class system_mvc_Controller implements system_mvc_Renderable
{
    /**
     * Handles any action that has been performed, relevant to this
     * controller. The base class implementation of this method does nothing.
     */
    public function handleActions()
    {
        // default behaviour: do nothing
    }

    /**
     * Renders the view(s) managed by this controller. The base class
     * implementation of this method does nothing.
     */
    public function render()
    {
        // default behaviour: render nothing
    }
}
