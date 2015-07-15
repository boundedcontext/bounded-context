<?php

namespace BoundedContext\Event\Store;

use BoundedContext\Identity;
use BoundedContext\Aggregate\Aggregate;

interface Store
{
	public function get_event_stream();

	public function get_event_stream_by_id(Identity $identity);

	public function save(Aggregate $aggregate);
}
