<?php

namespace BoundedContext;

use Rhumsaa\Uuid\Uuid as RhumsaaUuid;

class Uuid implements Identifiable
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

	public static function generate()
	{
		return new Uuid(RhumsaaUuid::uuid4());
	}
}
