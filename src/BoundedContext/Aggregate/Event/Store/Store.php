<?php

namespace OliveMedia\BoundedContext\Domain\Aggregate\Store;

use OliveMedia\BoundedContext\Domain\ValueObject\Identity;
use OliveMedia\BoundedContext\Domain\Event\Event;

interface Store 
{

	public function get_event_collection();

	public function append(Identity $id, Collection $e);
}