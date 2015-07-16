<?php

namespace BoundedContext\Event;

use BoundedContext\Uuid;

class AbstractEvent implements Event 
{
	protected $_id;
	protected $_version;

	public function id()
	{
		return new Uuid($this->_id);
	}

	public function version()
	{
		return $this->_version;
	}	
}