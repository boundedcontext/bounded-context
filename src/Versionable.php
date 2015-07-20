<?php namespace BoundedContext;

interface Versionable
{

    /**
     * Gets a version number.
     *
     * @return int
     */
    public function version();
}
