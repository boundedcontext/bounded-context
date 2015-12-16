<?php namespace BoundedContext\Contracts\Schema;

use BoundedContext\Contracts\Core\Versionable;
use BoundedContext\Contracts\Schema\Schema;

interface Upgrader extends Versionable {

    /**
     * Runs the upgrader.
     *
     * @return void
     */

    public function run();

    /**
     * Returns the current Schema.
     *
     * @return Schema
     */

    public function schema();
}