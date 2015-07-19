<?php
use BoundedContext\Uuid;
use BoundedContext\Collection;
use BoundedContext\Event\Log;
use BoundedContext\Event\Log\Item;

class EventLogMemoryAdapterTests extends PHPUnit_Framework_TestCase
{

    private $collection;
    private $log;

    public function setup()
    {
        $id = Uuid::generate();
        
        $this->collection = new Collection(array(
            Item::from_event(Uuid::generate(), new \DateTime, new GenericEvent($id, 'A')),
            Item::from_event(Uuid::generate(), new \DateTime, new GenericEvent($id, 'B')),
            Item::from_event(Uuid::generate(), new \DateTime, new GenericEvent($id, 'C')),
        ));

        $this->log = new Log\Adapter\Memory($this->collection);
    }

    public function test_append_event()
    {
        $this->log->append_event(
            new GenericEvent(Uuid::generate(), 'D')
        );

        $collection = $this->log->dump();

        $collection->next();
        $collection->next();
        $collection->next();

        $this->assertEquals(
            $collection->current()->payload()->item, 'D'
        );
    }

    public function test_append_collection()
    {
        $this->log->append_collection(new Collection(array(
            new GenericEvent(Uuid::generate(), 'D'),
            new GenericEvent(Uuid::generate(), 'E'),
            new GenericEvent(Uuid::generate(), 'F')
        )));

        $collection = $this->log->dump();

        $collection->next();
        $collection->next();
        $collection->next();

        $this->assertEquals(
            $collection->current()->payload()->item, 'D'
        );

        $collection->next();

        $this->assertEquals(
            $collection->current()->payload()->item, 'E'
        );

        $collection->next();

        $this->assertEquals(
            $collection->current()->payload()->item, 'F'
        );
    }
}
