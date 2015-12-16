<?php namespace BoundedContext\Contracts\Schema;

interface Schema
{
    public function get();

    public function add($key, \Closure $changes = null);

    public function upgrade($key, \Closure $changes);

    public function rename($old_key, $new_key);

    public function remove($key);
}