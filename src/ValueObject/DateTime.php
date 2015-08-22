<?php namespace BoundedContext\ValueObject;

use BoundedContext\Contracts\ValueObject;

class DateTime implements ValueObject
{
    private $date_time;

    public function __construct($date_time = 'now')
    {
        $this->date_time = new \DateTime($date_time);
    }

    public function serialize()
    {
        return $this->date_time->format(DATE_ISO8601);
    }

    public function equals(Uuid $other)
    {
        return ($this->serialize() == $other->serialize());
    }

    public static function now()
    {
        return new DateTime();
    }

    public static function deserialize($date_time = null)
    {
        return new DateTime($date_time);
    }
}
