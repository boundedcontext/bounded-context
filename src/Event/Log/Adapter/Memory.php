<?php

namespace BoundedContext\Event\Log\Adapter;

use BoundedContext\Uuid;
use BoundedContext\Collection;
use BoundedContext\Event\Event;

use BoundedContext\Event\Log\Log;
use BoundedContext\Event\Log\Item;

class Memory implements Log
{
	private $collection;

	public function __construct(Collection $collection)
	{
		$this->collection = $collection;
	}

	public function dump()
	{
		return $this->collection;
	}

	public function append_collection(Collection $collection)
	{
		foreach($collection as $event)
		{
			if(!$event instanceof Event)
			{
				throw new \Exception('A Log can only append Events.');
			}

			$item = Item::from_event(
				Uuid::generate(),
				new \DateTime,
				$event
			);

			$this->collection->append($item);
		}
	}

	public function append_event(Event $event)
	{
		$item = Item::from_event(
			Uuid::generate(),
			new \DateTime,
			$event
		);

		$this->collection->append($item);
	}
}