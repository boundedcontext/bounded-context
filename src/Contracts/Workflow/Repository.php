<?php namespace BoundedContext\Contracts\Workflow;

use BoundedContext\Contracts\ValueObject\Identifier;

interface Repository
{
    /**
     * @param Identifier $id
     * @return Workflow
     */

    public function get(Identifier $id);

    /**
     * @param Workflow $workflow
     * @return void
     */

    public function save(Workflow $workflow);
}
