<?php

namespace BoundedContext\Event\Store;

interface Event
{
	public function id();

	public function occured_at();

	public function version();
}
