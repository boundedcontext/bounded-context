<?php namespace BoundedContext\Examples\Recruitment\Aggregate\User\Projection\State;

use BoundedContext\Examples\Recruitment\Aggregate\User\Event;
use BoundedContext\Event\Projector\Adapter\Abstracted;

class Projector extends Abstracted
{

    public function when_created(Event\Created $event)
    {
        $this->projection->mutate([
            'username' => $event->username,
            'password' => $event->password,
            'is_created' => 1
        ]);
    }

    public function when_username_changed(Event\UsernameChanged $event)
    {
        $this->projection->mutate([
            'username' => $event->username
        ]);
    }

    public function when_password_changed(Event\PasswordChanged $event)
    {
        $this->projection->mutate([
            'password' => $event->password
        ]);
    }

    public function when_deleted(Event\Deleted $event)
    {
        $this->projection->mutate([
            'is_deleted' => 1
        ]);
    }

    public function when_undeleted(Event\Undeleted $event)
    {
        $this->projection->mutate([
            'is_deleted' => 0
        ]);
    }
}
