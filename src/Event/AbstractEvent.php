<?php namespace BoundedContext\Event;

use BoundedContext\ValueObject\Uuid;

class AbstractEvent implements Event
{
    public $id;
    
    protected $_type_id;
    protected $_version;
    
    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

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
    
    public function toArray()
    {
        $event = [];
        
        $class_vars = get_class_vars(get_class($this));

        foreach ($class_vars as $name => $value) {
            $event[$name] = $value;
        }
        
        return $event;
    }
}
