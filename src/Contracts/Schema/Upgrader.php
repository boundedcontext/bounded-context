<?php

namespace BoundedContext\Contracts\Schema;

use BoundedContext\Contracts\Core\Versionable;
use BoundedContext\Contracts\Schema\Schema;
use BoundedContext\ValueObject\Version;

interface Upgrader extends Versionable {

    public function __construct(Schema $schema, Version $version);

    public function run();

    public function schema();
}