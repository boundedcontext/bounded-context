<?php

namespace BoundedContext\Contracts;

use BoundedContext\ValueObject\Uuid;

interface Projection extends Versionable
{
    public function last_id();

    public function count();

    public function reset();

    public function save();

    public function set_last_id(Uuid $id);

    public function increment_version();

    public function increment_count();
}