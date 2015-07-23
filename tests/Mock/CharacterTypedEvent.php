<?php
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;

class CharacterTypedEvent extends AbstractEvent
{

    public $character;

    public function __construct(Uuid $id, DateTime $occured_at, $character)
    {
        parent::__construct($id, $occured_at);

        $this->character = $character;
    }
}
