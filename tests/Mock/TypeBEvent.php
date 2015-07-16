<?php

use BoundedContext\Event\AbstractEvent;

class TypeBEvent extends AbstractEvent
{
    protected $_id = '7b3bda43-5ccf-4815-ab2c-e2ff3dad7434';
    protected $_version = 1;

    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }
}