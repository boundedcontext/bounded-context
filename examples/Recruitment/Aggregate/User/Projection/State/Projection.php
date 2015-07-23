<?php namespace BoundedContext\Examples\Recruitment\Aggregate\User\Projection\State;

use BoundedContext\Event\Projection\Adapter\Abstracted;

class Projection extends Abstracted
{

    public $is_created;
    public $is_deleted;
    public $username;
    public $password;

    public function assert_not_created()
    {
        if ($this->is_created) {
            throw new \Exception('User is already created.');
        }
    }
}
