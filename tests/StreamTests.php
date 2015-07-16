<?php

use BoundedContext\Collectable;
use BoundedContext\Collection;

use BoundedContext\Event\Stream;

class StreamTests extends PHPUnit_Framework_TestCase
{
    private $collection;
    private $stream;

    public function setup()
    {
        $this->collection = new Collection(array(
            new MockCollectableItem('A'),
            new MockCollectableItem('B'),
            new MockCollectableItem('C')
        ));

        $this->stream = new Stream\Adapter\Memory(
            $this->collection
        );
    }

    public function test_ordering()
    {
        $item = $this->stream->next();

        $this->assertEquals($item, 'A');
        $this->assertEquals(
            $this->stream->last_id(), 
            $item->id()
        );

        $item = $this->stream->next();

        $this->assertEquals($item, 'B');
        $this->assertEquals(
            $this->stream->last_id(), 
            $item->id()
        ); 

        $item = $this->stream->next();

        $this->assertEquals($item, 'C');
        $this->assertEquals(
            $this->stream->last_id(), 
            $item->id()
        );

        $this->assertFalse(
            $this->stream->has_next()
        );
    }

    public function test_position()
    {
        $item = $this->stream->next();
        $this->assertEquals($item, 'A');

        $item = $this->stream->next();
        $this->assertEquals($item, 'B');

        $item = $this->stream->next();
        $this->assertEquals($item, 'C');

        $this->stream->position(
            new MockCollectableItem('A')
        );

        $item = $this->stream->next();
        $this->assertEquals($item, 'B');

        $item = $this->stream->next();
        $this->assertEquals($item, 'C');

        $this->stream->position(
            new MockCollectableItem('B')
        );

        $item = $this->stream->next();
        $this->assertEquals($item, 'C');

        $this->assertEquals(
            $this->stream->last_id(), 
            $item->id()
        );
    }
}
