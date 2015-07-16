<?php

use BoundedContext\Uuid;
use BoundedContext\Collectable;
use BoundedContext\Collection;

class EventProjectionTests extends PHPUnit_Framework_TestCase
{
    private $projection;

    public function setup()
    {
        $this->projection = new SentenceProjection();
    }

    public function test_add_sentence()
    {
        $sentence = "The quick brown fox jumped over the lazy dog.";

        $this->projection->add_word('The');
        $this->projection->add_word('quick');
        $this->projection->add_word('brown');
        $this->projection->add_word('fox');
        $this->projection->add_word('jumped');
        $this->projection->add_word('over');
        $this->projection->add_word('the');
        $this->projection->add_word('lazy');
        $this->projection->add_word('dog');
        $this->projection->add_character('.');

        $this->assertEquals(
            $this->projection->last_character,
            '.'
        );

        $this->assertEquals(
            $this->projection->character_count,
            strlen($sentence)
        );

        $this->assertEquals(
            $this->projection->concatenated_string,
            $sentence
        );
    }

    public function test_add_sentence_with_mistake()
    {
        $sentence = "The quick brown fox jumped over the lazy dog.";

        $this->projection->add_word('The');
        $this->projection->add_word('quick');
        $this->projection->add_word('brown');
        $this->projection->add_word('fox');
        $this->projection->add_word('jumpexr');

        $this->assertEquals(
            $this->projection->last_character,
            'r'
        );

        $this->projection->remove_character();

        $this->assertEquals(
            $this->projection->last_character,
            'x'
        );

        $this->projection->remove_character();

        $this->assertEquals(
            $this->projection->last_character,
            'e'
        );

        $this->projection->add_character('d');
        $this->projection->add_word('over');
        $this->projection->add_word('the');
        $this->projection->add_word('lazy');
        $this->projection->add_word('dog');
        $this->projection->add_character('.');

        $this->assertEquals(
            $this->projection->last_character,
            '.'
        );

        $this->assertEquals(
            $this->projection->character_count,
            strlen($sentence)
        );

        $this->assertEquals(
            $this->projection->concatenated_string,
            $sentence
        );
    }
}
