<?php namespace BoundedContext\Event\Stream\Adapter;

use BoundedContext\ValueObject\Uuid;
use BoundedContext\Collection\Collection;
use BoundedContext\Event\Stream\Stream;

class Memory implements Stream
{

    private $last_id;
    private $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
        $this->collection->rewind();

        $this->last_id = null;
    }

    public function last_id()
    {
        return $this->last_id;
    }

    public function has_next()
    {
        return $this->collection->has_next();
    }

    public function next()
    {
        if ($this->last_id !== null) {
            $this->collection->next();
        }

        $this->last_id = $this->collection->current()->id();

        return $this->collection->current()->payload();
    }

    public function move_to_id(Uuid $last_id)
    {
        $this->collection->rewind();
        $this->last_id = null;

        foreach ($this->collection as $item) {
            if ($item->id() == $last_id) {
                $this->last_id = $last_id;
                return true;
            }
        }

        if (is_null($this->last_id)) {
            throw new \Exception('The identifier does not exist in this stream.');
        }
    }
}
