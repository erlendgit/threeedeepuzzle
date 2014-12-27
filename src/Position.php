<?php

namespace ThreeDeePuzzle;

class Position {
	public $x;
	public $y;
	public $z;
	public $dir;
	public $rot;

	public function __construct($x, $y, $z, $dir, $rot) {
		$this->x = $x;
		$this->y = $y;
		$this->z = $z;
		$this->dir = $dir;
		$this->rot = $rot;
	}
}