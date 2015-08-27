<?php namespace BoundedContext\Projection;

use BoundedContext\ValueObject\Uuid;
use BoundedContext\ValueObject\Version;

abstract class AbstractProjection
{
    protected $last_id;
    protected $version;
    protected $count;

    public function __construct(Uuid $last_id, Version $version, Version $count)
    {
        $this->last_id = $last_id;
        $this->version = $version;
        $this->count = $count;
    }

    public function version()
    {
        return $this->version;
    }

    public function count()
    {
        return $this->count;
    }

    public function last_id()
    {
        return $this->last_id;
    }

    public function reset()
    {
        $this->last_id = Uuid::null();
        $this->version = new Version(0);
        $this->count = new Version(0);
    }

    public function set_last_id(Uuid $last_id)
    {
        $this->last_id = $last_id;
    }

    public function increment_version()
    {
        $this->version = $this->version->increment();
    }

    public function increment_count()
    {
        $this->count = $this->count->increment();
    }
}
