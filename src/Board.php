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

  // constructor
  public function __construct($rowsX, $rowsY, $rowsZ) {
    $this->match = array();
    $this->lbfColor = Point::CLEAR;

    $this->dimX = $rowsX - 1;
    $this->dimY = $rowsY - 1;
    $this->dimZ = $rowsZ - 1;
  }
  
  public function report() {
    $this->log('Expected color: ' . $this->lbfColor, __FUNCTION__);
    $this->log(print_r($this->match, TRUE), __FUNCTION__);
  }
  
  public function validParity($even, $color) {
    if (!$even && $color == $this->lbfColor) {
      return FALSE;
    } else if ($even && $color != $this->lbfColor) {
      return FALSE;
    }
    return TRUE;
  }

  public function apply(Shape $shape, Position $pos, $undo = FALSE) {
    // try to put shape at pos
    // two criteria:
    // 1) The color must match the expected color
    // calculate the expected color, and verify with the shape
    $first = $shape->firstPoint();
    $sum = $first->sum() + $pos->sum();
    $even = (($sum % 2) == 0);
    
    if ($this->lbfColor != Point::CLEAR) {
      if (!$this->validParity($even, $first->color)) {
        $shape->log('Mismatch by color: ' . $this->lbfColor, __FUNCTION__);
        return FALSE;
      }
    } else {
      
    }

    $hashTable = array();
    // 2) All locations must be empty.
    // 
    foreach($shape->allPoints() as $point) {
      $hash = $point->hash($pos);
      if ($undo) {
        unset($this->match[$hash]);
      } else {
        if (!empty($this->match[$hash])) {
          $shape->log('Mismatch by position', __FUNCTION__);
          return FALSE;
        }
        $hashTable[$hash] = $point->apply($pos, $shape->getId());
      }
    }
    
    if ($undo) {
      if (count($this->match) == 0) {
        $this->lbfColor = Point::CLEAR;
      }
    } else {
      $this->match = array_merge($this->match, $hashTable);

      if ($even && ($first->color == Point::WHITE)) {
        $this->lbfColor = Point::WHITE;
      } else {
        $this->lbfColor = Point::BLACK;
      }
    }
    return TRUE;
  }

}
