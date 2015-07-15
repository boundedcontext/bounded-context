  <?php

namespace BoundedContext\Event\Store\Adapter;

use BoundedContext\Collection;
use BoundedContext\Identity;

use BoundedContext\Event\Store;

use BoundedContext\Event\Aggregate\Aggregate;

class Memory implements Store\Store
{
	public $events;

	public __construct(Collection $event_collection)
	{
		foreach($event_collection as $key => $val)
		{
			$this->events[$val->id] = $val;
		}
	}

	public function get_event_stream()
	{
		return new Stream\Adapter\Memory(
			$this->events
		);
	}

	public function get_event_stream_by_id(Identity $id)
	{
		return new Stream\Adapter\Memory(
			$id = $id->toString();
			$this->events[$id]
		);
	}

	public function save(Aggregate $aggregate)
	{
		foreach($aggregate->changes() as $key => $val)
		{
			$this->events[$val->id][] = $val;
		}
	}
}