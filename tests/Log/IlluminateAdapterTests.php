<?php

use BoundedContext\ValueObject\Uuid;
use BoundedContext\Map\Map;
use BoundedContext\Map\Route;
use BoundedContext\Collection\Collection;
use BoundedContext\Log;
use Illuminate\Database\Capsule\Manager as Capsule;

class IlluminateAdapterTests extends PHPUnit_Framework_TestCase
{

    private $capsule;
    private $log;
    private $map;

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
        
        $this->map = new Map(new Collection(array(
            new Route(Uuid::generate(), 'GenericAppendable')
        )));

        $this->log = new Log\Adapter\Illuminate(
            $this->map, $this->capsule, 'default', 'event_log'
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

    public function test_append()
    {
        $this->log->append(
            new GenericAppendable('A')
        );

        $this->log->append(
            new GenericAppendable('B')
        );

        $this->log->append(
            new GenericAppendable('C')
        );
        
        $rows = $this->capsule->getConnection('default')
            ->table('event_log')
            ->orderBy('id', 'asc')
            ->get();
        
        $item = json_decode($rows[0]->item);
        $this->assertEquals('A', $item->payload->item);
        
        $item = json_decode($rows[1]->item);
        $this->assertEquals('B', $item->payload->item);
        
        $item = json_decode($rows[2]->item);
        $this->assertEquals('C', $item->payload->item);
    }

    public function test_append_collection()
    {
        $this->log->append_collection(new Collection(array(
            new GenericAppendable('D'),
            new GenericAppendable('E'),
            new GenericAppendable('F')
        )));

        $rows = $this->capsule->getConnection('default')
            ->table('event_log')
            ->orderBy('id', 'asc')
            ->get();
        
        $item = json_decode($rows[0]->item);
        $this->assertEquals('D', $item->payload->item);
        
        $item = json_decode($rows[1]->item);
        $this->assertEquals('E', $item->payload->item);
        
        $item = json_decode($rows[2]->item);
        $this->assertEquals('F', $item->payload->item);
    }
}
