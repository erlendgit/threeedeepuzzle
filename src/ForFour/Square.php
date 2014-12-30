<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle\ForFour;

use ThreeDeePuzzle\Shape;
use ThreeDeePuzzle\Point;

class Square extends Shape {

  public function rotationsPossible() {
    return array(0, 90);
  }
  
  public function mirrorPossible() {
    return array('no');
  }

  protected function coordinates() {
    $coordinates = array(
      //        ri up aw color
      new Point(0, 0, 0, Point::WHITE),
      new Point(0, 0, 1, Point::BLACK),
      new Point(0, 1, 0, Point::BLACK),
      new Point(0, 1, 1, Point::WHITE),
      new Point(1, 0, 0, Point::BLACK),
      new Point(1, 0, 1, Point::WHITE),
      new Point(1, 1, 0, Point::WHITE),
      new Point(1, 1, 1, Point::BLACK),
    );

    return $coordinates;
  }

}
