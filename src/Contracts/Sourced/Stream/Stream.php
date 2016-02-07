<?php namespace BoundedContext\Contracts\Sourced\Stream;

interface Stream extends \Iterator
{
    /**
     * Returns a new Stream for the Log.
     *
     * @return Stream
     */
    public function stream();
}
