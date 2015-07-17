<?php

namespace BoundedContext\Aggregate;

use BoundedContext\Uuid;
use BoundedContext\Collection;
use BoundedContext\Event\Event;
use BoundedContext\Event\Projector\Projector;

abstract class AbstractAggregate implements Aggregate {

    protected $id;
    protected $projector;
    private $changes;

    public function __construct(Uuid $id, Projector $projector) {
        $this->id = $id;

        $this->changes = new Collection();

        $this->projector = $projector;
        $this->projector->play();
    }

    public function id() {
        return $this->id;
    }

    public function version() {
        return $this->projector->version();
    }

    public function changes() {
        return $this->changes;
    }

    protected function apply(Event $e) {
        $this->projector->apply($e);

        $this->changes->append($e);
    }

}
