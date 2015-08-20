<?php
use BoundedContext\Log\Appendable;
use BoundedContext\ValueObject\Uuid;

class GenericAppendable implements Appendable
{

    public $id;
    public $item;
    
    public function id()
    {
        return $this->id;
    }

    public function __construct(Uuid $id, $item)
    {
        $this->id = $id;
        $this->item = $item;
    }
}
