<?php

use BoundedContext\Collectable;
use BoundedContext\Collection;

use BoundedContext\Event\Log;
use BoundedContext\Event\Log\Item;

class MemoryStoreTests extends PHPUnit_Framework_TestCase
{
    private $collection;
    private $log;

    public function setup()
    {
        $this->collection = new Collection(array(
            new Item('1', 'type-1-id', 'time', 1, array('item' => 'A')),
            new Item('2', 'type-2-id', 'time', 1, array('item' => 'B')),
            new Item('3', 'type-1-id', 'time', 2, array('item' => 'C')),
            //new Item('4', 'type-3-id', 'time', 1, array('item' => 'D')),
            //new Item('5', 'type-1-id', 'time', 3, array('item' => 'E')),
            //new Item('6', 'type-1-id', 'time', 4, array('item' => 'F')),
            //new Item('7', 'type-3-id', 'time', 2, array('item' => 'G')),
            //new Item('8', 'type-2-id', 'time', 2, array('item' => 'H')),
        ));

        $this->log = new Store\Adapter\Memory($this->collection);
    }

    public function test_append()
    {
        $this->log->append(new Collection(
            new MockStoreEvent('4', 'type-3-id', 'time', 1, array('item' => 'D')),
            new MockStoreEvent('5', 'type-1-id', 'time', 3, array('item' => 'E')),
            new MockStoreEvent('6', 'type-1-id', 'time', 4, array('item' => 'F'))
        ));

        $collection = $this->log->dump();

        $collection->next();
        $collection->next();

        $collection->next();
        $this->assetEquals($collection->current()->id(), '4');

        $collection->next();
        $this->assetEquals($collection->current()->id(), '5');

        $collection->next();
        $this->assetEquals($collection->current()->id(), '6');
    }
}
