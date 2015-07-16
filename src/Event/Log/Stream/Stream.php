<?php

namespace BoundedContext\Event\Log\Stream;

use BoundedContext\Uuid;

interface Stream
{
	public function last_id();

	public function move_to_id(Uuid $id);

	public function has_next();

	public function next();
}
