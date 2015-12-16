<?php namespace BoundedContext\Upgrader;


use BoundedContext\Contracts\Schema\Schema;
use BoundedContext\Contracts\Schema\Upgrader;
use BoundedContext\ValueObject\Integer;

abstract class AbstractUpgrader implements Upgrader
{
    use Upgrading;

    private $schema;
    private $version;

    public function __construct(Schema $schema, Integer $version)
    {
        $this->schema = $schema;
        $this->version = $version;

        if($version->serialize() == 0)
        {
            $this->schema->add('id');
        }
    }

    public function schema()
    {
        return $this->schema->get();
    }
}
