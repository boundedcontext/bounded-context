<?php
use BoundedContext\ValueObject\Uuid;

class EventTests extends PHPUnit_Framework_TestCase
{

    public function test_event()
    {
        $id = Uuid::generate();

        $event = new GenericEvent($id, 'A');

        $this->assertTrue(
            $event->id()->equals($id)
        );
        
        $this->assertEquals(
            $event->version(), 1
        );

        $this->assertEquals(
            $event->item, 'A'
        );

        $this->assertTrue(
            $event->toArray() ===
            array(
                'id' => $id->toString(),
                'item' => 'A'
            )
        );
    }
}
