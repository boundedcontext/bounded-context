<?php

namespace BoundedContext\Event\Projector\Adapter;

use BoundedContext\Collection;

use BoundedContext\Event\Projectable;

use BoundedContext\Event\Projection\Projection;

use BoundedContext\Event\Projector\Projector;
use BoundedContext\Event\Projector\Projecting;

abstract class Abstracted implements Projector
{
	use Projecting;

	protected $events;
	protected $projection;

	public function __construct(Collection $events, Projection $projection)
	{
		$this->events = $events;
		$this->projection = $projection;
	}

	public function reset()
	{
		$this->events->rewind();

		$class = get_class($projection);
		$this->projection = new $class;
	}

	public function play()
	{
		while($this->events->valid())
		{
			$event = $this->events->current();

			$this->mutate(
				$event
			);

			$this->events->next();
		}
	}

	public function apply(Projectable $p)
	{
		$this->play();
		$this->mutate($p);
	}

	public function current()
	{
		return $this->projection;
	}
}
