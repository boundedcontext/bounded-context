<?php

namespace BoundedContext\Event\Stream;

use BoundedContext\Identifiable;

interface Stream
{
	public function last_id();

	public function position(Identifiable $id);

	public function has_next();

	public function next();
}
