<?php

namespace OliveMedia\BoundedContext\Domain\Aggregate\Root;

use OliveMedia\BoundedContext\Domain\Event\Event;

interface Root 
{
	protected function apply(Event $e);

	protected function changes();
}