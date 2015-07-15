<?php

namespace BoundedContext\Examples\Recruitment\Aggregate\User\Projection\UsernameUnique;

use BoundedContext\Examples\Recruitment\Aggregate\User\Event;

use BoundedContext\Event\Projection\AbstractProjector;

class Projector extends AbstractProjector
{
	public function when_created(Event\Created $event)
	{
		$this->projection->add([
			'id' => $event->id,
			'username' => $event->username
		]);
	}

	public function when_username_changed(Event\UsernameChanged $event)
	{
		$this->projection->update([
			'id' => $event->id,
			'username' => $event->username
		]);
	}
}
