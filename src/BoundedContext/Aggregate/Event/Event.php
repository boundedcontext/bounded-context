<?php

namespace OliveMedia\BoundedContext\Domain\Event;

interface Event 
{

	public function id();
	public function aggregate_id();

}