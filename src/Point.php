<?php
	
namespace ThreeDeePuzzle;

define('TDP_CLEAR', 'clear');
define('TDP_BLACK', 'black');
define('TDP_WHITE', 'white');

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