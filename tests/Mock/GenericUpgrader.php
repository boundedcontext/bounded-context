<?php
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Upgrader\AbstractUpgrader;

class GenericUpgrader extends AbstractUpgrader
{

    protected function when_version_1()
    {
        $this->payload['item'] = 'B';
    }
    
    protected function when_version_2()
    {
        $this->payload['item'] = 'A';
    }
    
    public function get()
    {
        $id = new Uuid($this->item->payload()->id);
        $item = $this->payload['item'];
        
        return new GenericEvent($id, $item);
    }
}
