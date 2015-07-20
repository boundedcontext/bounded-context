<?php namespace BoundedContext\Projection\Adapter;

use BoundedContext\Projection\Projection;

abstract class Abstracted implements Projection
{

    private function check_property_exists($key)
    {
        if (!property_exists($this, $key)) {
            throw new \Exception('The property \'' . $key . '\' does not exist.');
        }
    }

    public function __set($key, $value)
    {
        $this->check_property_exists();

        $this->$key = $value;
    }

    public function __get($key)
    {
        $this->check_property_exists();

        return $this->$key;
    }
}
