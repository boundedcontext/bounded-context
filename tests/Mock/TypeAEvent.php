<?php
use BoundedContext\Event\AbstractEvent;

class TypeAEvent extends AbstractEvent
{

    protected $_id = 'cd3eda63-9c91-4c0f-a42b-4c1685b309a6';
    protected $_version = 1;
    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }
}
