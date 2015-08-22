<?php

namespace BoundedContext\Contracts;

use BoundedContext\ValueObject\Version;

interface Upgrader extends Versionable {

    public function __construct(Schema $schema, Version $version);

    public function run();

    public function schema();
}