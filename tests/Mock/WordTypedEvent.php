<?php
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Event\AbstractEvent;

class WordTypedEvent extends AbstractEvent
{

    public $word;

    public function __construct(Uuid $id, DateTime $occured_at, $word)
    {
        parent::__construct($id, $occured_at);

        $this->word = $word;
    }
}
