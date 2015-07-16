<?php

use BoundedContext\Uuid;
use BoundedContext\Collectable;
use BoundedContext\Collection;

use BoundedContext\Event\Log;
use BoundedContext\Event\Log\Item;

use BoundedContext\Event\AbstractEvent;

class EventLogItemTests extends PHPUnit_Framework_TestCase
{
    public function test_item()
    {
        $id = Uuid::generate();
        $type_id = Uuid::generate();
        $date_time = new \DateTime;
        $version = 1;
        $event = new GenericEvent('A');

        $item = new Item($id, $type_id, $date_time, $version, $event);

        $this->assertTrue(
            $id->equals($item->id())
        );

        $this->assertTrue(
            $type_id->equals($item->type_id())
        );

        $this->assertEquals(
            $date_time,
            $item->occured_at()
        );

        $this->assertEquals(
            $version,
            $item->version()
        );
    }

    public function test_from_event()
    {
        $id = Uuid::generate();
        $date_time = new \DateTime;
        $event = new GenericEvent('A');

        $item = Item::from_event($id, $date_time, $event);

        $this->assertTrue(
            $item->id()->equals($id)
        );

        $this->assertEquals(
            $item->occured_at(),
            $date_time
        );

        $this->assertTrue(
            $item->type_id()->equals($event->id())
        );

        $this->assertEquals(
            $item->version(),
            $event->version()
        );
    }
}
