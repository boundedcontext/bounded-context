<?php

namespace BoundedContext\Command;

use BoundedContext;

use BoundedContext\Aggregate\Aggregate;

interface Handler extends BoundedContext\Handler;
{
	public function __construct(Aggregate $aggregate);
}
