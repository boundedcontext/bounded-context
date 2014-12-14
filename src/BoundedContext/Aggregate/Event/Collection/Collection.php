<?php

namespace OliveMedia\BoundedContext\Domain\Aggregate\Event\Collection;

use OliveMedia\BoundedContext\Domain\Event\Event;

interface Collection implements \Iterator
{
	public function __construct(array $events);

	public function aggregate_id();

	public function append(Event $e);
}