<?php
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;

class CharacterTypedEvent extends AbstractEvent
{

    protected $_type_id = '02668e8f-8b60-4c46-be4d-94fbb2439fbb';
    protected $_version = 1;
    public $character;

    public function __construct(Uuid $id, $character)
    {
        $this->id = $id;
        $this->character = $character;
    }
}
