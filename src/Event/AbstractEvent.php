<?php

namespace BoundedContext\Event;

class AbstractEvent implements Event 
{
	public function id()
	{
		return $this->id;
	}
}