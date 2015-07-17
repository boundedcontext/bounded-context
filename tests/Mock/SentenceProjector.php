<?php

use BoundedContext\Event\AbstractEvent;

use BoundedContext\Event\Projector;

class SentenceProjector extends Projector\Adapter\Abstracted
{
	protected function set_projection()
	{
		$this->projection = new SentenceProjection();
	}

	public function when_character_typed_event(CharacterTypedEvent $event)
	{
		$this->projection->add_character($event->character);
	}

	public function when_word_typed_event(WordTypedEvent $event)
	{
		$this->projection->add_word($event->word);
	}

	public function when_backspace_pressed_event(BackspacePressedEvent $event)
	{
		$this->projection->remove_character();
	}
}

