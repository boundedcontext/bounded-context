<?php
/*use BoundedContext\ValueObject\Uuid;
use BoundedContext\Log\Item;

class ItemTests extends PHPUnit_Framework_TestCase
{

    public function test_item()
    {
        $id = new Uuid('17c39d00-2b4d-11e5-a2cb-0800200c9a66');
        $type_id = new Uuid('02668e8f-8b60-4c46-be4d-94fbb2439fbb');
        $date_time = new \DateTime("2015-07-21T23:24:58+0000");
        $version = 1;
        $payload = array(
            'item' => 'A'
        );

        $item = new Item($id, $type_id, $date_time, $version, $event);

        $this->assertTrue(
            $item->id()->equals($id)
        );

        $this->assertTrue(
            $item->type_id()->equals($type_id)
        );

        $this->assertEquals(
            $item->occured_at(), $date_time
        );

        $this->assertEquals(
            $item->version(), $version
        );

        $this->assertEquals(
            $item->payload()->item, 'A'
        );

        $json = '{"id":"17c39d00-2b4d-11e5-a2cb-0800200c9a66","type_id":"02668e8f-8b60-4c46-be4d-94fbb2439fbb","occured_at":"2015-07-21T23:24:58+0000","version":1,"payload":{"item":"A"}}';

        $this->assertEquals(
            $item->to_json(), $json
        );
    }

    public function test_from_json()
    {
        $json = '
            {
                "id": "17c39d00-2b4d-11e5-a2cb-0800200c9a66",
                "type_id": "02668e8f-8b60-4c46-be4d-94fbb2439fbb",
                "occured_at": "2015-07-15T23:57:13+00:00",
                "version": 1,
                "payload": {
                    "id": "a794ef60-2b4d-11e5-a2cb-0800200c9a66",
                    "item": "A"
                }
            }
        ';

        $item = Item::from_json($json);

        $id = new Uuid('17c39d00-2b4d-11e5-a2cb-0800200c9a66');

        $this->assertTrue(
            $item->id()->equals($id)
        );

        $date_time = new \DateTime('2015-07-15T23:57:13+00:00');

        $this->assertEquals(
            $item->occured_at(), $date_time
        );

        $this->assertEquals(
            $item->version(), 1
        );

        $event_type_id = new Uuid('02668e8f-8b60-4c46-be4d-94fbb2439fbb');

        $this->assertTrue(
            $item->type_id()->equals($event_type_id)
        );

        $this->assertEquals(
            $item->payload()->id, 'a794ef60-2b4d-11e5-a2cb-0800200c9a66'
        );

        $this->assertEquals(
            $item->payload()->item, 'A'
        );
    }
}*/
