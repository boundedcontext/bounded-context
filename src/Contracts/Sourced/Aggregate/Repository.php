<?php namespace BoundedContext\Contracts\Sourced\Aggregate;

use BoundedContext\Contracts\ValueObject\Identifier;

interface Repository {

    /**
     * Returns an Aggregate by id.
     *
     * @param Identifier $id
     * @return Aggregate
     */

    public function id(Identifier $id);

    /**
     * Saves an Aggregate to the Repository.
     *
     * @param Aggregate $aggregate
     * @return void
     */

    public function save(Aggregate $aggregate);
}
