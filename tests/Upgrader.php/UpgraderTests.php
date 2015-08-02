<?php
use BoundedContext\ValueObject\Uuid;
use BoundedContext\Log\Item;

class UpgraderTests extends PHPUnit_Framework_TestCase
{

    public function test_upgrader()
    {
        $id = new Uuid('17c39d00-2b4d-11e5-a2cb-0800200c9a66');
        $type_id = new Uuid('02668e8f-8b60-4c46-be4d-94fbb2439fbb');
        $date_time = new \DateTime('2015-07-21T23:24:58+0000');
        $version = 1;

        $payload = array(
            'id' => '37c39d00-2b4d-11e5-a2cb-0800200c9a69',
        );

        $item = new Item($id, $type_id, $date_time, $version, $payload);

        $upgrader = new GenericUpgrader($item);

        $event = $upgrader->get();

        $this->assertInstanceOf('GenericEvent', $event);
        $this->assertEquals('A', $event->item);
        $this->assertEquals(3, $upgrader->version());
    }
}
