<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle\AfterFour;

use ThreeDeePuzzle\Shape;

class Thee extends Shape {

  public function xPossible($dir, $rot) {
    
  }

  public function yPossible($dir, $rot) {
    
  }

  public function zPossible($dir, $rot) {
    
  }

  protected function coordinates() {
    $coordinates = array(
      //        ri up aw color
      // new Point(0, 0, 0, 'white'),
      // new Point(0, 0, 1, 'black'),
      // new Point(0, 1, 0, 'black'),
      // new Point(0, 1, 1, 'white'),
      // new Point(1, 0, 0, 'black'),
      // new Point(1, 0, 1, 'white'),
      // new Point(1, 1, 0, 'white'),
      // new Point(1, 1, 1, 'black'),
    );

    $this->log($coordinates, __FUNCTION__);

    return $coordinates;
  }

}
