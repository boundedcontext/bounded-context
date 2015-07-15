<?php

namespace OliveMedia\BoundedContext\Workflow;

use OliveMedia\BoundedContext\Event\Handler;

abstract class Abstract extends Handler\Abstract
{

	public function apply(Event $c) {

		$this->aggregate->reset(
			$this->store->get_event_collection()
		);

		$this->mutate($c);

		$this->store->append(
			$this->aggregate->changes()
		);
	}

}