<?php

namespace BoundedContext\Stream;

use BoundedContext\Collection\Collection;
use BoundedContext\Contracts\Sourced\Log;
use BoundedContext\ValueObject\Uuid;

class Stream implements \BoundedContext\Contracts\Stream
{
    private $log;
    private $last_id;

    private $limit;
    private $chunk_size;

    private $items_streamed;

    private $items;

    public function __construct(Log $log, Uuid $last_id, $limit = 1000, $chunk_size = 1000)
    {
        $this->log = $log;
        $this->last_id = $last_id;
        $this->limit = $limit;
        $this->chunk_size = $chunk_size;

        $this->items_streamed = 0;

        $this->items = new Collection();
    }

    private function is_unlimited()
    {
        return ($this->limit == 0);
    }

    private function is_limit_hit()
    {
        if($this->is_unlimited())
        {
            return false;
        }

        if($this->items_streamed < $this->limit)
        {
            return false;
        }

        return true;
    }

    public function last_id()
    {
        return $this->last_id;
    }

    public function has_next()
    {
        if($this->is_limit_hit())
        {
            return false;
        }

        if(!$this->items->has_next())
        {
            $this->items = $this->log->get_collection(
                $this->last_id,
                $this->chunk_size
            );
        }

        if($this->items->is_empty())
        {
            return false;
        }

        return $this->items->has_next();
    }

    public function next()
    {
        $item = $this->items->current();

        if($this->has_next())
        {
            $this->items->next();
        }

        $this->items_streamed += 1;
        $this->last_id = $item->id();

        return $item;
    }
}