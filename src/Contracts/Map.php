<?php

namespace BoundedContext\Contracts;

use BoundedContext\ValueObject\Uuid;

interface Map
{
    public function get_event_class(Uuid $id);

    public function get_id(Event $event);
}