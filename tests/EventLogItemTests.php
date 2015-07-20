<?php
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Event\Log\Item;

class EventLogItemTests extends PHPUnit_Framework_TestCase
{

    public function test_item()
    {
        $id = Uuid::generate();
        $type_id = Uuid::generate();
        $date_time = new \DateTime;
        $version = 1;
        $event = new GenericEvent(Uuid::generate(), 'A');

        $item = new Item($id, $type_id, $date_time, $version, $event);

        $this->assertTrue(
            $id->equals($item->id())
        );

        $this->assertTrue(
            $type_id->equals($item->type_id())
        );

        $this->assertEquals(
            $date_time, $item->occured_at()
        );

        $this->assertEquals(
            $version, $item->version()
        );
    }

    public function test_from_event()
    {
        $id = Uuid::generate();
        $date_time = new \DateTime;
        $event = new GenericEvent(Uuid::generate(), 'A');

        $item = Item::from_event($id, $date_time, $event);

        $this->assertTrue(
            $item->id()->equals($id)
        );

        $this->assertEquals(
            $item->occured_at(), $date_time
        );

        $this->assertTrue(
            $item->type_id()->equals($event->type_id())
        );

        $this->assertEquals(
            $item->version(), $event->version()
        );
        
        /*$this->assertTrue(
            array_diff($item->toArray(),
                [
                    'id' => $id->toString(),
                    'type_id' => $event->type_id()->toString(),
                    'occured_at' => $date_time->format(DateTime::ISO8601),
                    'version' => $event->version()
                ]
            )
        );*/
    }
    
    /*public function test_from_json()
    {
        $json = "
            {
                id: '17c39d00-2b4d-11e5-a2cb-0800200c9a66',
                type_id: '02668e8f-8b60-4c46-be4d-94fbb2439fbb',
                occured_at: '2015-07-15T23:57:13+00:00',
                version: 1,
                payload: {
                    id: 'a794ef60-2b4d-11e5-a2cb-0800200c9a66',
                    item: 'A'
                }
            }
        ";
        
        $item = Item::from_json($json);
        
        $id = new Uuid('17c39d00-2b4d-11e5-a2cb-0800200c9a66');
        
        $this->assertTrue(
            $item->id()->equals($id)
        );
        
        $date_time = new \DateTime('2015-07-15T23:57:13+00:00');
        
        $this->assertTrue(
            $item->occured_at()->format('U') == $date_time->format('U')
        );
        
        $this->assertEquals(
            $item->version(), 1
        );
        
        $event_id = new Uuid('a794ef60-2b4d-11e5-a2cb-0800200c9a66');
        
        $this->assertTrue(
            $item->payload()->id()->equals($event_id)
        );
        
        $event_type_id = new Uuid('a794ef60-2b4d-11e5-a2cb-0800200c9a66');
        
        $this->assertTrue(
            $item->payload()->type_id()->equals($event_type_id)
        );
        
        $this->assertEquals(
            $item->payload()->item,
            'A'
        );
        
        $this->assertInstanceOf(
            $item->payload(),
            'GenericEvent'
        );
    }*/
}
