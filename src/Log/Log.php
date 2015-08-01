<?php namespace BoundedContext\Log;

use BoundedContext\Collection\Collection;

interface Log
{

    public function append_collection(Collection $collection);

    public function append(Appendable $appendable);
}
