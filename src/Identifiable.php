<?php namespace BoundedContext;

interface Identifiable
{

    /**
     * Gets a unique Uuid identifier.
     *
     * @return \BoundedContext\Uuid
     */
    public function id();
}
