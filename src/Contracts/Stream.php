<?php namespace BoundedContext\Contracts;

interface Stream {

    public function last_id();

    public function has_next();

    public function next();
}