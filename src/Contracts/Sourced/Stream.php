<?php namespace BoundedContext\Contracts\Sourced;

interface Stream {

    public function last_id();

    public function has_next();

    public function next();
}