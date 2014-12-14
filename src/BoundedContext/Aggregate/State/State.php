<?php

namespace OliveMedia\BoundedContext\Aggregate\State;

use OliveMedia\BoundedContext\Aggregate\Event\Collection\Collection;
use OliveMedia\BoundedContext\Aggregate\Event\Event;

interface State 
{

	public function __construct(Collection $c);

	public function version();

	public function apply(Event $e);

	protected function mutate(Event $e);
}