<?php

namespace OliveMedia\BoundedContext\Domain\Aggregate\Command;

use OliveMedia\BoundedContext\Domain\Aggregate\Store\Store;

interface Handler 
{

	public function __construct(Store $store);

	protected function apply(Command $e);

	protected function mutate(Command $e);
}