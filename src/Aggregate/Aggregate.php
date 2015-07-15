<?php

namespace BoundedContext\Aggregate;

use BoundedContext\Event\Event;

interface Aggregate
{
	public function id();
	
	public function changes();

	public function version();
}