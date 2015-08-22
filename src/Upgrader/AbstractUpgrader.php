<?php namespace BoundedContext\Upgrader;


use BoundedContext\Contracts\Schema;
use BoundedContext\Contracts\Upgrader;
use BoundedContext\ValueObject\Version;

abstract class AbstractUpgrader implements Upgrader
{
    use Upgrading;

    private $schema;
    private $version;

    public function __construct(Schema $schema, Version $version)
    {
        $this->schema = $schema;
        $this->version = $version;

        if($version->toString() == 0)
        {
            $this->schema->add('id');
        }
    }
}
