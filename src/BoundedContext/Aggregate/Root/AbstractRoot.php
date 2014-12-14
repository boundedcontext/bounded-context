<?php

namespace OliveMedia\BoundedContext\Aggregate\Root;

use OliveMedia\BoundedContext\Aggregate\State\State;

use OliveMedia\BoundedContext\Aggregate\Event\Collection\Collection;
use OliveMedia\BoundedContext\Aggregate\Event\Event;

public abstract class AbstractRoot implements Root 
{

	private $state;
	private $unit_of_work;

	public function __construct(Collection $existing_events) {

		$this->state = new State($existing_events);
		$this->unit_of_work = new Collection();
	}

	/*

	public function some_command($entity_id, $foo, $bar, Service $s) {

		$entity = $this->state->get_some_entity($entity_id);

		if($entity->some_condition()) {
			$this->apply(new AggregateEvent1($this->state->id, $entity_id, $foo));
		} else {
			$this->apply(new AggregateEvent2($this->state->id, $entity_id, $bar));
		}

		if($service->condition($entity)) {
			$this->apply(new AggregateEvent3($this->state->id));
		}
		
	}
	
	*/

	protected function apply(Event $e) {

		$this->state->apply($e);

		$this->unit_of_work->append($e);
	}

	protected function changes() {
		return $this->unit_of_work;
	}

}