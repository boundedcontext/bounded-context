<?php
use BoundedContext\Event\AbstractEvent;

class WordTypedEvent extends AbstractEvent
{

    protected $_id = '22668e8f-8b60-4c46-be4d-94fbb2439fbb';
    protected $_version = 1;
    public $word;

    public function __construct($word)
    {
        $this->word = $word;
    }
}
