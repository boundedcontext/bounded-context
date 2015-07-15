<?php

namespace BoundedContext;

class Collection implements \Iterator
{
	private $key;	
	private $items;

	public function __construct(array $items = []) {

		$this->reset();

		foreach($items as $item) {
			$this->append($item);
		}
	}

	public function reset() {
		$this->items = [];
		$this->rewind();
	}

	public function append($e) {
		$this->items[] = $e;
	}

	public function rewind() {
		$this->key = 0;
	}

	public function current() {
		return $this->items[$this->key];
	}

	public function key() {
		return $this->key;
	}

	public function next() {
		$this->key = $this->key + 1;
	}

	public function valid() {
		return isset($this->items[$this->key]);
	}
}
