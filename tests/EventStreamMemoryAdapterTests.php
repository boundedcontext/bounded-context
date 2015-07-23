<?php
/*use BoundedContext\ValueObject\Uuid;
use BoundedContext\Collection\Collection;
use BoundedContext\Event\Stream;
use BoundedContext\Event\Log\Item;

class EventStreamMemoryAdapterTests extends PHPUnit_Framework_TestCase
{

    private $collection;
    private $stream;

    public function setup()
    {
        $id = Uuid::generate();
        
        $this->collection = new Collection(array(
            Item::from_event(
                new Uuid('157a56d2-b157-4c02-b55c-95b63820cbfc'), new \DateTime, new GenericEvent($id, 'A')
            ),
            Item::from_event(
                new Uuid('8e993601-bb2a-4b5e-8a7e-2caa0e79e504'), new \DateTime, new GenericEvent($id, 'B')
            ),
            Item::from_event(
                new Uuid('2de8f232-097d-4ff0-92c6-4c271b7631e0'), new \DateTime, new GenericEvent($id, 'C')
            ),
        ));

        $this->stream = new Stream\Adapter\Memory(
            $this->collection
        );
    }

    public function test_stream_ordering()
    {
        $event = $this->stream->next();

        $this->assertEquals($event->item, 'A');

        $this->assertTrue(
            $this->stream->has_next()
        );

        $event = $this->stream->next();
        $this->assertEquals($event->item, 'B');

        $this->assertTrue(
            $this->stream->has_next()
        );

        $event = $this->stream->next();
        $this->assertEquals($event->item, 'C');

        $this->assertFalse(
            $this->stream->has_next()
        );
    }

    public function test_position()
    {
        $event = $this->stream->next();
        $this->assertEquals($event->item, 'A');

        $event = $this->stream->next();
        $this->assertEquals($event->item, 'B');

        $event = $this->stream->next();
        $this->assertEquals($event->item, 'C');

        $this->stream->move_to_id(
            new Uuid('157a56d2-b157-4c02-b55c-95b63820cbfc')
        );

        $event = $this->stream->next();
        $this->assertEquals($event->item, 'B');

        $event = $this->stream->next();
        $this->assertEquals($event->item, 'C');

        $this->stream->move_to_id(
            new Uuid('8e993601-bb2a-4b5e-8a7e-2caa0e79e504')
        );

        $event = $this->stream->next();
        $this->assertEquals($event->item, 'C');
    }
}*/
