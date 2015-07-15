<?php

namespace BoundedContext\Event\Projection\Adapter;

class Eloquent extends AbstractProjection
{
	private $models;

	public function __construct($version)
	{
		$this->models['version'] = $version_model;
	}

	public function __set($key, $value)
	{
		$this->check_property_exists();

		$this->$key = $value;
	}

	public function __get($key)
	{
		$this->check_property_exists();

		return $this->$key;
	}
}
