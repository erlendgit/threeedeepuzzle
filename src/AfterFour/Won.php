<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle\AfterFour;

use ThreeDeePuzzle\Shape;
use ThreeDeePuzzle\Point;

class Won extends Shape {

  protected function coordinates() {
    $coordinates = array(
      new Point(0, 0, 0, Point::WHITE),
      new Point(0, 0, 1, Point::BLACK),
      new Point(0, 0, 2, Point::WHITE),
      new Point(0, 0, 3, Point::BLACK),
      new Point(0, 1, 1, Point::WHITE),
    );

    return $coordinates;
  }

}
