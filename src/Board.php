<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle;

class Board {

  use Logable;

  public $applications;

  /**
   *
   * @var Point
   */
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
    $this->applications = array();

    $this->dimX = $rowsX - 1;
    $this->dimY = $rowsY - 1;
    $this->dimZ = $rowsZ - 1;
  }

  public function report() {
    $this->log('Expected color: ' . $this->lbfColor, __FUNCTION__);

    $xyzColor = array();
    $xyzShape = array();

    //x normal
    foreach (range(0, $this->dimX) as $rowX) {
      // y reverse to proper print to screen
      foreach (range($this->dimY, 0) as $rowY) {
        // z normal
        foreach (range(0, $this->dimZ) as $rowZ) {
          $position = new Position($rowX, $rowY, $rowZ);
          $point = @$this->match[$position->hash()];

          if ($point) {
            $id = $point->id;
            $color = $point->color;
          } else {
            $id = Point::CLEAR;
            $color = Point::CLEAR;
          }

          $xyzShape[$rowX][$rowY] = $xyzShape[$rowX][$rowY] . $id;
          $xyzColor[$rowX][$rowY] = $xyzColor[$rowX][$rowY] . $color;
        }
      }
    }

    foreach ($xyzColor as $x => $yz) {
      $description = "slice at prosition $x";
      foreach ($yz as $y => $z) {
        $description = "$description\n[{$z}] [{$xyzShape[$x][$y]}]";
      }
      $this->log($description);
    }
  }

  public function validParity($even, $color) {
    if (!$even && $color == $this->lbfColor) {
      return FALSE;
    } else if ($even && $color != $this->lbfColor) {
      return FALSE;
    }
    return TRUE;
  }

  public function undo(Shape $shape) {
    if ($this->applications[$shape->getId()]) {
      unset($this->applications[$shape->getId()]);
      
      //$this->log(implode(', ', array_keys($this->applications)), __FUNCTION__);
      
      $remove = array();

      foreach ($this->match as $hash => $point) {
        if ($point->id == $shape->getId()) {
          $remove[] = $hash;
        }
      }

      foreach ($remove as $hash) {
        unset($this->match[$hash]);
      }

      if (count($this->match) > 0) {
        return;
      }

      $this->lbfColor = Point::CLEAR;
    }
  }

  /**
   * Apply a shape to the board (if possible)
   * @param \ThreeDeePuzzle\Shape $shape
   * @param \ThreeDeePuzzle\Position $pos
   * @return boolean
   */
  public function apply(Shape $shape, Position $pos) {
    // try to put shape at pos
    // two criteria:
    // 1) The color must match the expected color
    // calculate the expected color, and verify with the shape
    $first = $shape->firstPoint();
    $sum = $first->sum() + $pos->sum();
    $even = (($sum % 2) == 0);

    if ($this->lbfColor != Point::CLEAR) {
      if (!$this->validParity($even, $first->color)) {
        return FALSE;
      }
    }

    $hashTable = array();
    // 2) All locations must be empty.
    // 
    foreach ($shape->allPoints() as $point) {
      $hash = $point->hash($pos);
      if (!empty($this->match[$hash])) {
        return FALSE;
      }
      $hashTable[$hash] = $point->apply($pos, $shape->getId());
    }

    $this->applications[$shape->getId()] = 1;
    $this->match = array_merge($this->match, $hashTable);

    if ($even && ($first->color == Point::WHITE)) {
      $this->lbfColor = Point::WHITE;
    } else {
      $this->lbfColor = Point::BLACK;
    }
    return TRUE;
  }

}
