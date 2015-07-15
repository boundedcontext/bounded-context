<?php

namespace BoundedContext\Event;

use BoundedContext\Event\Projectable;

interface Event extends Projectable
{
	public function id();
}