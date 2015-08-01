<?php

use BoundedContext\Log\Appendable;

class GenericAppendable implements Appendable
{

    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }
}
