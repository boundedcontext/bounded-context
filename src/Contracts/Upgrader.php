<?php

namespace BoundedContext\Contracts;

use BoundedContext\Contracts\Core\Versionable;
use BoundedContext\ValueObject\Version;

interface Upgrader extends Versionable {

    public function __construct(Schema $schema, Version $version);

    public function run();

    public function schema();
}