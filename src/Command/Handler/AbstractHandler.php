<?php

namespace OliveMedia\BoundedContext\Command\Handler;

use OliveMedia\BoundedContext\Event\Handler\AbstractHandler as EventAbstractHandler;

use OliveMedia\BoundedContext\Event\Store\Store;
use OliveMedia\BoundedContext\Aggregate\Aggregate;
use OliveMedia\BoundedContext\Command\Command;

abstract class AbstractHandler extends EventAbstractHandler
{
	private $store;
	private $aggregate;

	public function __construct(Store $store, Aggregate $aggregate) {

		$this->store = $store;
		$this->aggregate = $aggregate;
	}

	public function apply(Command $c) {

		$this->aggregate->reset(
			$this->store->get_event_collection($c->id)
		);

		$this->mutate($c);

		$this->store->append(
			$this->aggregate->changes()
		);
	}
}
