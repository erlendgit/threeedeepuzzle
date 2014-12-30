<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle;

class Board {

  use Logable;

  // chain of correctly placed elements
  public $match;
  
  // max x
  public $dimX;
  // max y
  public $dimY;
  // max z
  public $dimZ;

  /**
   * Left-bottom-front color, to estimate the other colors
   * @var integer
   */
  public $lbfColor;
  // Matrix of occupied locations [x][y][z]
  // occupied locations
  protected $occ;

  // constructor
  public function __construct($rowsX, $rowsY, $rowsZ) {
    $this->match = array();
    $this->lbfColor = TDP_CLEAR;
    
    $this->dimX = $rowsX - 1;
    $this->dimY = $rowsY - 1;
    $this->dimZ = $rowsZ - 1;
  }

  public function apply(Shape $shape, Position $pos) {
    // add the shape to the $occ list.

    if ($this->lbfColor == LBF_CLEAR) {
      // set the color;
    }

    // and register my shape.
    $result->match[] = array(
      'shape' => $shape,
      'position' => $position,
    );
  }

  public function test(Shape $shape, Position $pos) {
    // try to put shape at pos
    // two criteria:
    // 1) The color must match the expected color
    if ($this->lbfColor != LBF_CLEAR) {
      // calculate the expected color, and verify with the shape
    }

    // 2) All locations must be empty.
    // if we can go there:
    if ($match) {
      $result = clone($this);
      $result->apply($shape, $pos);
      return $result;
    }

    // else, fail
    return FALSE;
  }

}
