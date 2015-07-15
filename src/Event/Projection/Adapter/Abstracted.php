<?php

namespace BoundedContext\Event\Projection\Adapter;

use BoundedContext\Event\Projection\Projection;

abstract class Abstracted implements Projection
{
	private $_version;

	public function __construct($version = 0)
	{
		$this->_version = $version;
	}

	private function check_property_exists($key)
	{
		if(!property_exists($this, $key))
		{
			throw new \Exception('The property \''.$key.'\' does not exist.');
		}
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

	public function mutate(array $changes)
	{
		if(empty($changes))
		{
			throw new \Exception('There is no data in this mutation.');
		}

		foreach($changes as $key => $val)
		{
			$this->$key = $val;
		}

		$this->_version += 1;
	}

	public function version()
	{
		return $this->_version;
	}
}
