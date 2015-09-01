<?php

namespace BoundedContext\Contracts;

interface State
{
    public function apply(Event $event);
}
