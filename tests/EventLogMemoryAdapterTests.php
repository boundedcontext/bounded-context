<?php

use BoundedContext\Uuid;
use BoundedContext\Collectable;
use BoundedContext\Collection;

use BoundedContext\Event\Log;
use BoundedContext\Event\Log\Item;

use BoundedContext\Event\AbstractEvent;

class MockEvent extends AbstractEvent
{
    protected $_id = '02668e8f-8b60-4c46-be4d-94fbb2439fbb';
    protected $_version = 1;

    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }
}

class EventLogMemoryAdapterTests extends PHPUnit_Framework_TestCase
{
    private $collection;
    private $log;

    public function setup()
    {
        $this->collection = new Collection(array(
            Item::from_event(Uuid::generate(), new \DateTime, new MockEvent('A')),
            Item::from_event(Uuid::generate(), new \DateTime, new MockEvent('B')),
            Item::from_event(Uuid::generate(), new \DateTime, new MockEvent('C')),
        ));

        $this->log = new Log\Adapter\Memory($this->collection);
    }

    public function test_append_event()
    {
        $this->log->append_event(
            new MockEvent('D')
        );

        $collection = $this->log->dump();

        $collection->next();
        $collection->next();

        $collection->next();
        $this->assertEquals(
            $collection->current()->payload()->id(),
            new Uuid('02668e8f-8b60-4c46-be4d-94fbb2439fbb')
        );
        $this->assertEquals(
            $collection->current()->payload()->version(),
            1
        );
        $this->assertEquals(
            $collection->current()->payload()->item,
            'D'
        );
    }

    public function test_append_collection()
    {
        $this->log->append_collection(new Collection(array(
            new MockEvent('D'),
            new MockEvent('E'),
            new MockEvent('F')
        )));

        $collection = $this->log->dump();

        $collection->next();
        $collection->next();

        $collection->next();

        $this->assertEquals(
            $collection->current()->payload()->item,
            'D'
        );

        $collection->next();

        $this->assertEquals(
            $collection->current()->payload()->item,
            'E'
        );

        $collection->next();

        $this->assertEquals(
            $collection->current()->payload()->item,
            'F'
        );
    }
}
