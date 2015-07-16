<?php

use BoundedContext\Collectable;
use BoundedContext\Collection;

class CollectableItem implements Collectable
{
    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function id()
    {
        return (string) $this->item;
    }

    public function __toString()
    {
        return (string) $this->item;
    }
}