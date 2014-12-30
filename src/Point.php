<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle;

define('TDP_CLEAR', 'clear');
define('TDP_BLACK', 'black');
define('TDP_WHITE', 'white');

class Point {

  public $x;
  public $y;
  public $z;
  public $color;

  public function __construct($x, $y, $z, $color = TDP_CLEAR) {
    $this->x = $x;
    $this->y = $y;
    $this->z = $z;
    $this->color = $color;
  }

}
