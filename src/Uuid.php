<?php

namespace BoundedContext;

use Rhumsaa\Uuid\Uuid as RhumsaaUuid;

class Uuid implements Identity
{
	private $uuid;

	public function __construct(RhumsaaUuid $uuid)
	{
		$this->uuid = $uuid;
	}

	public function toString()
	{
		return $this->uuid->toString();
	}
}
