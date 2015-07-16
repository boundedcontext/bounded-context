<?php

use BoundedContext\Event\AbstractEvent;

use BoundedContext\Event\Projector;

class ConcatenationProjector extends Projector\Adapter\Abstracted
{
	public function when_character_typed(CharacterPressed $event)
	{
		$this->projection->add_character($event->item);
	}

	public function when_word_typed(WordTyped $event)
	{
		$this->projection->add_word($event->item);
	}

	public function when_backspace_pressed(BackspacePressed $event)
	{
		$this->projection->remove_character();
	}

	public function when_enter_pressed(EnterPressed $event)
	{
		$this->projection->add_character("\n");
	}
}

// The quick brown fox jumped over the lazy dog.
