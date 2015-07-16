<?php

use BoundedContext\Event\AbstractEvent;

class TypeCEvent extends AbstractEvent
{
    protected $_id = '3bc7b759-e98f-4a38-bc36-0c8464570bb4';
    protected $_version = 1;

    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }
}