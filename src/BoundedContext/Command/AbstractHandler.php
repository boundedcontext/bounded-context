<?php

namespace OliveMedia\BoundedContext\Domain\Aggregate\Command;

use OliveMedia\BoundedContext\Domain\Event\Collection;
use OliveMedia\BoundedContext\Domain\Event\Event;

public abstract class AbstractHandler implements Handler 
{

	private $store;
	private $aggregate_root;

	public function __construct(Store $store, AbstractRoot $aggregate_root) {

		$this->store = $store;
		$this->aggregate_root = $aggregate_root;

	protected function apply(Command $c) {

		$this->aggregate_root = new AggregateRoot(
			$this->store->get_event_collection()
		);

		$this->mutate($c);

		$this->store->append(
			$this->aggregate_root->changes()
		);
	}

	protected function mutate(Command $c) {

		/*

		if(get_class($c) == 'SomeCommand') {

			$this->aggregate_root->some_command($c->foo, $c->bar);
		}

		*/

		// throw new CommandNotExistsException('The commend given is not recognised.');
	}
}