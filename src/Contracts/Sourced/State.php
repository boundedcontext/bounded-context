<?php

namespace BoundedContext\Contracts\Sourced;

use BoundedContext\Contracts\Event;

interface State
{
    public function apply(Event $event);
}
