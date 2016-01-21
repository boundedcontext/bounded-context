<?php namespace BoundedContext\Contracts\Core;

use BoundedContext\Contracts\ValueObject\DateTime;

interface Temporal
{
    /**
     * Get the current DateTime of the Temporal object.
     *
     * @return DateTime
     */

    public function occurred_at();
}
