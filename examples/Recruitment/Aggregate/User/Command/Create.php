<?php namespace BoundedContext\Examples\Recruitment\Aggregate\User\Command;

use BoundedContext\Command\Command;

class Create implements Command
{

    public $id;
    public $username;
    public $password;

    public function __construct($id, $username, $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }
}
