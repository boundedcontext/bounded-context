<?php
use BoundedContext\ValueObject\Uuid;

class EventTests extends PHPUnit_Framework_TestCase
{

    public function test_event()
    {
        $id = Uuid::generate();
        $date_time = new \DateTime;

        $event = new GenericEvent($id, $date_time, 'A');

        $this->assertTrue(
            $event->id()->equals($id)
        );

        $this->assertEquals(
            $event->occured_at()->format('U'), $date_time->format('U')
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
