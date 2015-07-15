<?php

namespace BoundedContext\Event\Store;

use BoundedContext\Identity;

interface Stream
{
	public function last_id();

	public function after(Identity $id);
}
