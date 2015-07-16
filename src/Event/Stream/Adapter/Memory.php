<?php

namespace BoundedContext\Event\Stream\Adapter;

use BoundedContext\Collection;
use BoundedContext\Identifiable;

use BoundedContext\Event\Stream\Stream;

class Memory implements Stream 
{
	private $last_id;
	private $collection;

	public function __construct(Collection $collection)
	{
		$this->collection = $collection;
		$this->collection->rewind();

		$this->last_id = null;
	}

	public function last_id()
	{
		return $this->last_id;
	}

	public function has_next()
	{
		return $this->collection->has_next();
	}

	public function next()
	{
		$this->last_id = $this->collection->current();

		$this->collection->next();

		return $this->last_id;
	}

	public function position(Identifiable $last_id)
	{
		$this->collection->rewind();
		$this->last_id = null;

		foreach($this->collection as $item)
		{
			if($item == $last_id)
			{
				if($this->has_next())
				{
					$this->next();
				}
				
				return true;
			}

			$this->last_id = $last_id;
		}

		if(is_null($this->last_id))
		{
			throw new \Exception('The identifier does not exist in this stream.');
		}
	}
}
