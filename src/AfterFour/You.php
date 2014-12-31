<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle\AfterFour;

use ThreeDeePuzzle\Shape;
use ThreeDeePuzzle\Point;

class You extends Shape {

  public function mirrorPossible() {
    return array('no');
  }

  protected function coordinates() {
    $coordinates = array(
      new Point(0, 0, 0, Point::WHITE),
      new Point(0, 0, 1, Point::BLACK),
      new Point(0, 0, 2, Point::WHITE),
      new Point(0, 1, 0, Point::BLACK),
      new Point(0, 1, 2, Point::BLACK),
    );

    return $coordinates;
  }

}
