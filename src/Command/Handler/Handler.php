<?php

namespace OliveMedia\BoundedContext\Command;

use OliveMedia\BoundedContext\Event\Store\Store;
use OliveMedia\BoundedContext\Aggregate\Aggregate;

use OliveMedia\BoundedContext\Command\Command;

interface Handler
{
	public function __construct(Store $store, Aggregate $aggregate);

	public function apply(Command $e);
}
