<?php namespace BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot;

use BoundedContext\Contracts\Sourced\Aggregate\State\State;
use BoundedContext\Contracts\ValueObject\Identifier;

interface Factory
{
    /**
     * Creates a new Snapshot from a State.
     *
     * @param Identifier $id
     * @return Snapshot
     */

    public function create(Identifier $id);

    /**
     * Creates a Snapshot from a Tree.
     *
     * @param array $tree
     * @return Snapshot
     */

    public function tree(array $tree);

    /**
     * Creates a Snapshot of a State.
     *
     * @param State $state
     * @return Snapshot
     */

    public function state(State $state);
}
