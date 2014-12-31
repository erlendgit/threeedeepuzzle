<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle\AfterFour;

use ThreeDeePuzzle\Point;

/**
 * Like ladder, but switched black and white
 */
class LadderWhite extends Ladder {

  protected function coordinates() {

    $coordinates = parent::coordinates();

    foreach ($coordinates as $point) {
      if ($point->color == Point::WHITE) {
        $point->color = Point::BLACK;
      } else {
        $point->color = Point::WHITE;
      }
    }

    return $coordinates;
  }

  // most complex shape, only one direction
  public function directionsPossible() {
    return array('x');
  }

  // most complex shape, only one rotation
  // let the others rotate around me, i'm not moving.
  public function rotationsPossible() {
    return array(0);
  }

}
