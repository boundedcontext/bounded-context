<?php

namespace BoundedContext\Event\Log;

use BoundedContext\Uuid;

use BoundedContext\Versionable;
use BoundedContext\Identifiable;
use BoundedContext\Collectable;

use BoundedContext\Event\Event;

class Item implements Collectable, Identifiable, Versionable
{
    private $id;
    private $type_id;
    private $occured_at;
    private $version;
    private $payload;

    public function __construct($id, $type_id, $occured_at, $version, $payload)
    {
        $this->id = $id;
        $this->type_id = $type_id;
        $this->occured_at = $occured_at;
        $this->version = $version;
        $this->payload = $payload;
    }

    public function id()
    {
        return $this->id;
    }

    public function type_id()
    {
        return $this->type_id;
    }

    public function occured_at()
    {
        return $this->occured_at;
    }

    public function version()
    {
        return $this->version;
    }

    public function payload()
    {
    	return $this->payload;
    }

    public static function from_event(Event $event)
    {
    	return new Item(
    		Uuid::generate(),
    		$event->type_id(),
    		new DateTime,
    		$event->version(),
    		$event
    	);
    }
}
