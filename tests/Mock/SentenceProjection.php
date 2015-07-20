<?php
use BoundedContext\Projection;

class SentenceProjection extends Projection\Adapter\Abstracted
{

    public $character_count = 0;
    public $concatenated_string = "";
    public $last_character = null;

    public function add_character($character)
    {
        $this->concatenated_string .= $character;
        $this->last_character = $character;
        $this->character_count += 1;
    }

    public function remove_character()
    {
        $this->concatenated_string = substr($this->concatenated_string, 0, -1);
        $this->last_character = substr($this->concatenated_string, -1);
        $this->character_count -= 1;
    }

    public function add_word($word)
    {
        if ($this->character_count !== 0) {
            $word = " " . $word;
        }

        $this->concatenated_string .= $word;
        $this->last_character = substr($this->concatenated_string, -1);
        $this->character_count += strlen($word);
    }
}
