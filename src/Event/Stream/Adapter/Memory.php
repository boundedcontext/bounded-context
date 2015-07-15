<?php

namespace BoundedContext\Event\Stream\Adapter;

use BoundedContext\Collection;
use BoundedContext\Event\Stream\Stream;

class Memory implements Stream 
{
	private $last_id;
	private $collection;

	public function __construct(Collection $collection)
	{
		$this->collection = $collection;
		$this->collection->rewind();
	}

	public function last_id()
	{
		return $this->last_id;
	}

	public function position(Identity $last_id)
	{
		$this->collection->rewind();
	}

}
