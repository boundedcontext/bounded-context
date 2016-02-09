<?php namespace BoundedContext\Sourced\Aggregate\Stream;

use BoundedContext\Contracts\Sourced\Aggregate\Stream\Factory as StreamFactory;
use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Contracts\Sourced\Aggregate\Stream\Stream;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\ValueObject\Integer as Integer_;

class Builder implements \BoundedContext\Contracts\Sourced\Aggregate\Stream\Builder
{
    private $stream_factory;

    private $id;
    private $version;
    private $chunk_size;

    public function __construct(
        IdentifierGenerator $generator,
        StreamFactory $stream_factory
    )
    {
        $this->stream_factory = $stream_factory;

        $this->id = $generator->null();
        $this->version = new Integer_();
        $this->chunk_size = new Integer_(1000);
    }

    /**
     * Sets that the Stream should look for snapshots after a version.
     *
     * @param Integer_ $version
     * @return \BoundedContext\Contracts\Sourced\Aggregate\Stream\Builder
     */
    public function after(Integer_ $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Sets that the Stream should look for snapshots with an id.
     *
     * @return \BoundedContext\Contracts\Sourced\Aggregate\Stream\Builder
     */
    public function with(Identifier $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Sets the chunk size from the data store.
     * Defaults to 1000.
     *
     * @return \BoundedContext\Contracts\Sourced\Aggregate\Stream\Builder
     */
    public function chunk(Integer_ $size)
    {
        $this->chunk_size = $size;

        return $this;
    }

    /**
     * Returns the configured Stream.
     *
     * @return Stream
     */
    public function stream()
    {
        return $this->stream_factory->create(
            $this->id,
            $this->version,
            $this->chunk_size
        );
    }
}
