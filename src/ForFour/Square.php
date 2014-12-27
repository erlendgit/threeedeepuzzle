<?php

namespace ThreeDeePuzzle\ForFour;

use ThreeDeePuzzle\Shape;

class Square extends Shape {
	public function xPossible($dir) {
		return array(0, 1, 2);
	}

	public function yPossible($dir) {
		return array(0, 1, 2);
	}

	public function zPossible($dir) {
		return array(0, 1, 2);
	}

	public function directionsPossible() {
		return array(
			'right',
		);
	}

	protected function coordinates() {
		$coordinates = array(
			//        ri up aw color
			new Point(0, 0, 0, 'white'),
			new Point(0, 0, 1, 'black'),
			new Point(0, 1, 0, 'black'),
			new Point(0, 1, 1, 'white'),
			new Point(1, 0, 0, 'black'),
			new Point(1, 0, 1, 'white'),
			new Point(1, 1, 0, 'white'),
			new Point(1, 1, 1, 'black'),
		);

		$this->log($coordinates, __FUNCTION__);

		return $coordinates;
	}
}