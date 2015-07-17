<?php

namespace BoundedContext\Aggregate;

use BoundedContext\Identifiable;
use BoundedContext\Versionable;

use BoundedContext\Event\Event;

interface Aggregate extends Identifiable, Versionable
{
	public function __construct(Identity $id, Projector $projector);
	
	public function changes();
}
