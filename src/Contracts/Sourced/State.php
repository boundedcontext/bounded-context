<?php

namespace BoundedContext\Contracts\Sourced;

use BoundedContext\Contracts\Event\Event;

interface State
{
    public function apply(Event $event);
}
