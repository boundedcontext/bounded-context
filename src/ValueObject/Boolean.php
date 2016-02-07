<?php namespace BoundedContext\ValueObject;

class Boolean extends AbstractValueObject
{
    private $boolean;

    public function __construct($boolean)
    {
        $this->boolean = ($boolean == true);
    }

    public function true()
    {
        return ($this->boolean == true);
    }

    public function false()
    {
        return ($this->boolean == false);
    }

    public function serialize()
    {
        return $this->boolean;
    }

    public static function deserialize($boolean = null)
    {
        return new Boolean($boolean);
    }
}
