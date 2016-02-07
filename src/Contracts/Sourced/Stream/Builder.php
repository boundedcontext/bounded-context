<?php namespace BoundedContext\Contracts\Sourced\Stream;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\ValueObject\Integer as Integer_;

interface Builder
{
    /**
     * Sets the Identifier to stream after.
     *
     * @return Builder
     */
    public function after(Identifier $id);

    /**
     * Sets the Stream to be the at the end of the Log.
     *
     * @return Builder
     */
    public function end();

    /**
     * Sets the chunk size of the Streamer.
     *
     * @return Builder
     */
    public function chunk(Integer_ $size);

    /**
     * Returns a new Stream for the Log.
     *
     * @return Stream
     */
    public function stream();
}
