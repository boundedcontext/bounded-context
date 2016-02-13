<?php namespace BoundedContext\Contracts\Sourced\Aggregate\Stream;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Contracts\Sourced\Stream\Stream;
use BoundedContext\ValueObject\Integer as Integer_;

interface Factory
{
    /**
     * Creates a new Stream.
     *
     * @param Identifier $aggregate_id
     * @param Integer_ $starting_offset
     * @param Integer_ $limit
     * @param Integer_ $chunk_size
     *
     * @return Stream
     */
    public function create(
        Identifier $aggregate_id,
        Integer_ $starting_offset,
        Integer_$limit,
        Integer_ $chunk_size
    );
}
