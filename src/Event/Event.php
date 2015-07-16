<?php

namespace BoundedContext\Event;

use BoundedContext\Collectable;
use BoundedContext\Event\Projectable;

interface Event extends Projectable, Collectable
{
	public function type_id();
}