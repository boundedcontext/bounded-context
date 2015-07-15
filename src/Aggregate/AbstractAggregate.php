<?php

namespace BoundedContext\Aggregate;

use BoundedContext\Aggregate\State\State;

use BoundedContext\Identity;
use BoundedContext\Collection;
use BoundedContext\Event\Event;
use BoundedContext\Event\Projector\Projector;

abstract class AbstractAggregate implements Aggregate 
{
	protected $id;

	protected $projector;
	private $changes;

	public function __construct(Identity $id, Projector $projector)
	{
		$this->id = $id;

		$this->changes = new Collection();

		$this->projector = $projector;
		$this->projector->play();
	}

	protected function apply(Event $e)
	{
		$this->projector->apply($e);

		$this->changes->append($e);
	}

	public function id()
	{
		return $this->id;
	}

	public function changes()
	{
		return $this->changes;
	}

	public function version()
	{
		return $this->projector->current()->version();
	}
}
