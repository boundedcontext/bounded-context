<?php namespace BoundedContext\Contracts\Player\Snapshot;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Contracts\Generator\DateTime as DateTimeGenerator;
use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;

interface Snapshot extends \BoundedContext\Contracts\Snapshot\Snapshot
{
    /**
     * Returns the last id of this Snapshot.
     *
     * @return Identifier
     */

    public function last_id();

    /**
     * Returns a new Snapshot after resetting it back to its default state.
     *
     * @param IdentifierGenerator $identifier_generator
     * @param DateTimeGenerator $datetime_generator
     *
     * @return Snapshot
     */

    public function reset(
        IdentifierGenerator $identifier_generator,
        DateTimeGenerator $datetime_generator
    );

    /**
     * Returns a new Snapshot after skipping the current id.
     *
     * @param Identifier $next_id
     * @param DateTimeGenerator $datetime_generator
     * @return Snapshot
     */

    public function skip(
        Identifier $next_id,
        DateTimeGenerator $datetime_generator
    );

    /**
     * Returns a new Snapshot after processing the current id.
     *
     * @return Snapshot
     */

    public function take(
        Identifier $next_id,
        DateTimeGenerator $datetime_generator
    );
}
