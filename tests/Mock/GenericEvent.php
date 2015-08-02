<?php
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;

class GenericEvent extends AbstractEvent
{

    public $item;

    public function __construct(Uuid $id, $item)
    {
        parent::__construct($id);

        $this->item = $item;
    }
}
