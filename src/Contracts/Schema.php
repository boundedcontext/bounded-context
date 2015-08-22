<?php

namespace BoundedContext\Contracts;

interface Schema
{
    public function get();

    public function add($key, \Closure $changes = null);

    public function upgrade($key, \Closure $changes);

    public function rename($old_key, $new_key);

    public function remove($key);
}

/*
 *
 * $schema = new Schema($existing_tree_structure);
 *
 * $schema->add('user'); // Defaults to null
 *
 * $schema->add('tree_key', function ($schema, $user)
 * {
 *      $schema->user = [
 *          'default_value' => 1,
 *          'renamed_value' => $user['named_value'];
 *      ];
 * });
 *
 * $schema->upgrade('user', function ($schema, $user){
 *      $schema->user = 'default_username';
 * });
 *
 * $schema->rename('user', 'username');
 *
 * $schema->delete('username');
 *
 */