<?php

namespace BoundedContext\Examples\Recruitment\Aggregate\User;

use BoundedContext\Examples\Recruitment\Aggregate\User\Event;
use BoundedContext\Aggregate\AbstractAggregate;

class Handler
{
    public function handle_create(Command/Create $command)
    {
        $username = new ValueObject\Username($username);
        $password = new ValueObject\Password($password);
        
        $this->aggregate->create($username, $password);
    }
}
