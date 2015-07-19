<?php namespace BoundedContext\Event;

use BoundedContext\Uuid;

class AbstractEvent implements Event
{
    public $id;
    
    protected $_type_id;
    protected $_version;

    public function id()
    {
        return $this->id;
    }
    
    public function type_id()
    {
        return new Uuid($this->_type_id);
    }


    public function version()
    {
        return $this->_version;
    }
}
