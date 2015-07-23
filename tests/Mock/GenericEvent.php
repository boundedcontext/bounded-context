<?php
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;

class GenericEvent extends AbstractEvent
{

    public $item;

    public function __construct(Uuid $id, DateTime $occured_at, $item)
    {
        parent::__construct($id, $occured_at);

        $this->item = $item;
    }
}
