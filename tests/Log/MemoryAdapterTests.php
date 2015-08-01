<?php
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Collection\Collection;
use BoundedContext\Log;
use BoundedContext\Log\Item;
use BoundedContext\Map\Map;
use BoundedContext\Map\Route;

class MemoryAdapterTests extends PHPUnit_Framework_TestCase
{

    private $collection;
    private $map;
    private $log;

    public function setup()
    {
        $event_type = Uuid::generate();

        $this->collection = new Collection(array(
            new Item(Uuid::generate(), $event_type, new \DateTime, 1, array('item' => 'A')),
            new Item(Uuid::generate(), $event_type, new \DateTime, 1, array('item' => 'B')),
            new Item(Uuid::generate(), $event_type, new \DateTime, 1, array('item' => 'C')),
        ));

        $this->map = new Map(new Collection(array(
            new Route($event_type, 'GenericAppendable')
        )));

        $this->log = new Log\Adapter\Memory($this->map, $this->collection);
    }

    public function test_append()
    {
        $this->log->append(
            new GenericAppendable('D')
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
            new GenericAppendable('D'),
            new GenericAppendable('E'),
            new GenericAppendable('F')
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
