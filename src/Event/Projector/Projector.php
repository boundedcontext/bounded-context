<?php

namespace BoundedContext\Event\Projector;

use BoundedContext\Event\Projectable;

interface Projector 
{
	public function reset();

	public function play();

	public function apply(Projectable $p);

	public function current();
}
