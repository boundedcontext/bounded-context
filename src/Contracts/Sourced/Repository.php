<?php namespace BoundedContext\Contracts\Sourced;

use BoundedContext\Contracts\ValueObject\Identifier;

interface Repository {

    /**
     * @param Identifier $id
     * @return Aggregate
     */

    public function get(Identifier $id);

    /**
     * @param Aggregate $aggregate
     * @return void
     */

    public function save(Aggregate $aggregate);

}
