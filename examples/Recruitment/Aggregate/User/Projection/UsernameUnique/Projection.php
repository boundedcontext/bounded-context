<?php

namespace BoundedContext\Examples\Recruitment\Aggregate\User\Projection\UsernameUnique;

use BoundedContext\Event\Projection\AbstractProjection;

class Projection extends AbstractProjection
{
	public $usernames;

	public function add($user)
	{
		$this->usernames[$user->id] = $user->username;
	}

	public function update($user)
	{
		$this->usernames[$user->id] = $user->username;
	}

	public function assert_not_exists($username)
	{
		if(isset($this->usernames[$event->id]) && $this->usernames[$event->id] != '')
		{
			throw new \Exception('Username already exists.');
		}
	}
}
