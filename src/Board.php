<?php

namespace ThreeDeePuzzle;

class Board {
	use Logable;
	// chain of correctly placed elements
	public $match;

	// occupied locations
	protected $occ;

	// constructor
	public function __construct() {
		$this->match = array();
	}

	public function apply(Shape $shape, Position $pos) {
		// add the shape to the $occ list.

		// and register my shape.
		$result->match[] = array(
			'shape' => $shape,
			'position' => $position,
		);
	}

	public function test(Shape $shape, Position $pos) {
		// try to put shape at pos

		// two criteria:

		// 1) The color must match the expected color

		// 2) All locations must be empty.

		// if we can go there:
		if ($match) {
			$result = clone($this);
			$result->apply($shape, $pos);
			return $result;
		}

		// else, fail
		return FALSE;
	}
}