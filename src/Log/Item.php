<?php namespace BoundedContext\Log;

use BoundedContext\ValueObject\Uuid;
use BoundedContext\Versionable;
use BoundedContext\Identifiable;
use BoundedContext\Collection\Collectable;

class Item implements Collectable, Identifiable, Versionable
{

    private $id;
    private $type_id;
    private $occured_at;
    private $version;
    private $payload;

    public function __construct(Uuid $id, Uuid $type_id, \DateTime $occured_at, $version, $payload)
    {
        $this->id = $id;
        $this->type_id = $type_id;
        $this->occured_at = $occured_at;
        $this->version = (int) $version;
        $this->payload = (object) $payload;
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

    public function to_array()
    {
        return [
            'id' => $this->id->toString(),
            'type_id' => $this->type_id->toString(),
            'occured_at' => $this->occured_at->format(\DateTime::ISO8601),
            'version' => (int) $this->version,
            'payload' => (array) $this->payload
        ];
    }
}
