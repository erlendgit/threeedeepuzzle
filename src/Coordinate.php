<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle;

class Coordinate {
  public $x;
  public $y;
  public $z;
  
  public function sum() {
    return $this->x + $this->y + $this->z;
  }
  
  public function hash(Coordinate $p = NULL) {
    if ($p) {
      return implode(', ', array(
        $this->x + $p->x,
        $this->y + $p->y,
        $this->z + $p->z,
      ));
    }
    return implode(', ', array(
      $this->x,
      $this->y,
      $this->z,
    ));
  }
  
  public function __construct($x, $y, $z) {
    $this->x = $x;
    $this->y = $y;
    $this->z = $z;
  }
}