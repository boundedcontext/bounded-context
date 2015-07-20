<?php namespace BoundedContext;

interface Identifiable
{

    /**
     * Gets an id from something identifiable.
     *
     * @return \BoundedContext\Uuid
     */
    public function id();
}
