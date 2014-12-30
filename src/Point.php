<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle;

class Point extends Coordinate {

  public $color;
  public $id;
  
  const CLEAR = '.';
  const BLACK = 'b';
  const WHITE = 'w';

  public function __construct($x, $y, $z, $color = Point::CLEAR) {
    parent::__construct($x, $y, $z);
    $this->color = $color;
  }
  
  public function apply(Position $p, $id = ' ') {
    $application = new Point($this->x + $p->x, $this->y + $p->y, $this->z + $p->z, $this->color);
    $application->id = $id;
    return $application;
  }

}
