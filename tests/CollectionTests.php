<?php

use BoundedContext\Collectable;
use BoundedContext\Collection;

class MockCollectableItem implements Collectable
{
    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function id()
    {
        return (string) $this->item;
    }

    public function __toString()
    {
        return (string) $this->item;
    }
}

class CollectionTests extends PHPUnit_Framework_TestCase
{
    private $collection;

    public function setup()
    {
        $this->collection = new Collection(array(
            new MockCollectableItem('A'),
            new MockCollectableItem('B'),
            new MockCollectableItem('C')
        ));
    }

    public function test_count()
    {
        $this->assertEquals($this->collection->count(), 3);
    }

    public function test_reset()
    {
        $this->assertEquals($this->collection->count(), 3);
        $this->collection->reset();
        $this->assertEquals($this->collection->count(), 0);
    }

    public function test_rewind()
    {
        $this->collection->next();
        $this->collection->next();

        $this->assertEquals($this->collection->current(), 'C');

        $this->collection->rewind();

        $this->assertEquals($this->collection->current(), 'A');
    }

    public function test_ordering()
    {
        $this->assertEquals($this->collection->current(), 'A');

        $this->assertTrue($this->collection->has_next());
        $this->collection->next();
        $this->assertEquals($this->collection->current(), 'B');

        $this->assertTrue($this->collection->has_next());
        $this->collection->next();
        $this->assertEquals($this->collection->current(), 'C');

        $this->assertFalse($this->collection->has_next());
    }

    public function test_append()
    {
        $this->collection->append(
            new MockCollectableItem('D')
        );

        $this->collection->next();
        $this->collection->next();

        $this->assertTrue($this->collection->has_next());
        $this->collection->next();

        $this->assertEquals($this->collection->current(), 'D');
        $this->assertFalse($this->collection->has_next());
    }

    public function test_append_after_reset()
    {
        $this->collection->reset();

        $this->assertFalse($this->collection->has_next());

        $this->collection->append(
            new MockCollectableItem('D')
        );

        $this->assertFalse($this->collection->has_next());
        $this->assertEquals($this->collection->current(), 'D');
    }

    public function test_append_after_playthrough()
    {
        $this->collection->next();
        $this->collection->next();

        $this->assertFalse($this->collection->has_next());

        $this->collection->append(
            new MockCollectableItem('D')
        );

        $this->assertTrue($this->collection->has_next());
        $this->collection->next();

        $this->assertFalse($this->collection->has_next());
        $this->assertEquals($this->collection->current(), 'D');
    }
}
