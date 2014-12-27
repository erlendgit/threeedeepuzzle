<?php
	
namespace ThreeDeePuzzle;

class Point {
	public $x;
	public $y;
	public $z;
	public $color;

	public function __construct($x, $y, $z, $color) {
		$this->x = $x;
		$this->y = $y;
		$this->z = $z;
		$this->color = $color;
	}

}