<?php

namespace OliveMedia\BoundedContext\Aggregate\State;

use OliveMedia\BoundedContext\Aggregate\Event\Collection\Collection;
use OliveMedia\BoundedContext\Aggregate\Event\Event;

public abstract class AbstractState implements State 
{

	private $version;

	public function __construct(Collection $c) {

		$this->version = 0;

		foreach($c as $event) {
			$this->apply($e);
		}
	}

	public function version() {
		return $this->version;
	}

	public function apply(Event $e) {

		$this->mutate($e);

		$this->version++;
	}

	protected function mutate(Event $e) {}

}