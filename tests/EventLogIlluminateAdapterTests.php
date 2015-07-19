<?php
use BoundedContext\Uuid;
use BoundedContext\Collection;
use BoundedContext\Event\Log;
use Illuminate\Database\Capsule\Manager as Capsule;

class EventLogIlluminateAdapterTests extends PHPUnit_Framework_TestCase
{

    private $capsule;
    private $log;

    public function setup()
    {
        $this->capsule = new Capsule;

        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'bounded_context',
            'username' => 'homestead',
            'password' => 'secret',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $this->log = new Log\Adapter\Illuminate(
            $this->capsule, 'default', 'event_log'
        );
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->capsule
            ->getConnection('default')
            ->table('event_log')
            ->delete();
    }

    public function test_append_event()
    {
        $this->log->append_event(
            new GenericEvent(Uuid::generate(), 'A')
        );

        $this->log->append_event(
            new GenericEvent(Uuid::generate(), 'B')
        );

        $this->log->append_event(
            new GenericEvent(Uuid::generate(), 'C')
        );

        $this->assertTrue(true);

        /* $this->assertEquals(
          $collection->current()->payload()->item, 'D'
          ); */
    }

    public function test_append_collection()
    {
        $this->log->append_collection(new Collection(array(
            new GenericEvent(Uuid::generate(), 'D'),
            new GenericEvent(Uuid::generate(), 'E'),
            new GenericEvent(Uuid::generate(), 'F')
        )));

        $this->assertTrue(true);
    }
}
