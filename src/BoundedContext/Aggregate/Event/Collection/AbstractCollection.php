<?php

namespace OliveMedia\BoundedContext\Domain\Aggregate\Event\Collection;

use OliveMedia\BoundedContext\Domain\Event\Event;

public abstract class AbstractCollection implements Collection
{

	private $aggregate_id;

	private $key;	
	private $array;

	public function __construct(array $events) {

		$this->rewind();

		foreach($events as $event) {
			$this->append($event);
		}
	}

	private function is_first_event() {
		return ($this->aggregation_id == null);
	}

	private function is_valid_aggregate_id(Event $e) {
		return ($this->aggregate_id == $e->aggregate_id());
	}

	public function append(Event $e) {

		if($this->is_first_event()) {
			$this->aggregation_id = $e->aggregate_id();
		}

		if($this->is_valid_aggregate_id($e)) {
			$this->array[] = $e;
		}
	}

	public function aggregate_id();

	public function rewind() {
		$this->key = 0;
	}

	public function current() {
		return $this->array[$this->key];
	}

	public function key() {
		return $this->key;
	}

	public function next() {
		$this->key = $this->key + 1;
	}

	public function valid() {
		return isset($this->array[$this->key]);
	}
}