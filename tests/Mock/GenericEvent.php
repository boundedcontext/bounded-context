<?php
use BoundedContext\Uuid;
use BoundedContext\Event\AbstractEvent;

class GenericEvent extends AbstractEvent
{

    protected $_type_id = '02668e8f-8b60-4c46-be4d-94fbb2439fbb';
    protected $_version = 1;
    
    public $item;

    public function __construct(Uuid $id, $item)
    {
        $this->id = $id;
        $this->item = $item;
    }
}
