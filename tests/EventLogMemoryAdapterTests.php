<?php
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Collection\Collection;
use BoundedContext\Event\Log;
use BoundedContext\Event\Log\Item;
use BoundedContext\Map\Map;
use BoundedContext\Map\Route;

class EventLogMemoryAdapterTests extends PHPUnit_Framework_TestCase
{

    private $collection;
    private $map;
    private $log;

    public function setup()
    {
        $id = Uuid::generate();
        
        $event_type = Uuid::generate();
        
        $this->collection = new Collection(array(
            new Item(Uuid::generate(), $event_type, new \DateTime, 1, array('id' => $id, 'item' => 'A')),
            new Item(Uuid::generate(), $event_type, new \DateTime, 1, array('id' => $id, 'item' => 'B')),
            new Item(Uuid::generate(), $event_type, new \DateTime, 1, array('id' => $id, 'item' => 'C')),
        ));
        
        $this->map = new Map(new Collection(array(
            new Route($event_type, 'GenericEvent')
        )));

        $this->log = new Log\Adapter\Memory($this->map, $this->collection);
    }

    public function test_append_event()
    {
        $this->log->append_event(
            new GenericEvent(Uuid::generate(), new \DateTime, 'D')
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
            new GenericEvent(Uuid::generate(), new \DateTime, 'D'),
            new GenericEvent(Uuid::generate(), new \DateTime, 'E'),
            new GenericEvent(Uuid::generate(), new \DateTime, 'F')
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
