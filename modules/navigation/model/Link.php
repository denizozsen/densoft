<?php

class modules_navigation_model_Link
{
	private $url;
	private $title;
	private $active;
	private $children;

	public function __construct($url, $title, $active = false, $children = array())
	{
		foreach($children as $child) {
			if (!($child instanceof NavigationLink)) {
				throw new Exception('children must be of type ' . get_class() . '.'
					. ' Child was of type ' . get_class($child));
			}
		}

		$this->url      = $url;
		$this->title    = $title;
		$this->active   = $active;
		$this->children = $children;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function isActive()
	{
		return $this->active;
	}

	public function hasChildren()
	{
		return (count($this->children) != 0);
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function addChild(modules_navigation_model_Link $child)
	{
		$this->children[] = $child;
	}
}
