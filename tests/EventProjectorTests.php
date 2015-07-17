<?php
use BoundedContext\Uuid;
use BoundedContext\Collection;
use BoundedContext\Event\Log\Stream;
use BoundedContext\Event\Log\Item;

class EventProjectorTests extends PHPUnit_Framework_TestCase
{

    private $projector;

    private function generate_projector($collection)
    {
        $stream = new Stream\Adapter\Memory(
            $collection
        );

        return new SentenceProjector(
            $stream
        );
    }

    public function test_projector()
    {
        $sentence = "Hello World!";

        $this->projector = $this->generate_projector(
            new Collection(array(
            Item::from_event(
                new Uuid('157a56d2-b157-4c02-b55c-95b63820cbfc'), new \DateTime, new WordTypedEvent('Hello')
            ),
            Item::from_event(
                new Uuid('8e993601-bb2a-4b5e-8a7e-2caa0e79e504'), new \DateTime, new WordTypedEvent('Worln')
            ),
            Item::from_event(
                new Uuid('8e993601-bb2a-4b5e-8a7e-2caa0e79e504'), new \DateTime, new BackspacePressedEvent()
            ),
            Item::from_event(
                new Uuid('2de8f232-097d-4ff0-92c6-4c271b7631e0'), new \DateTime, new CharacterTypedEvent('d')
            ),
            ))
        );

        $this->projector->play();

        $this->projector->apply(
            new CharacterTypedEvent('!')
        );

        $this->assertEquals(
            $this->projector->version(), 5
        );

        $this->assertEquals(
            $this->projector->state()->last_character, '!'
        );

        $this->assertEquals(
            $this->projector->state()->character_count, strlen($sentence)
        );

        $this->assertEquals(
            $this->projector->state()->concatenated_string, $sentence
        );
    }
}
