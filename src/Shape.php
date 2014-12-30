<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle;

class Shape {

  use Logable;

  // x (right) direction posible rows
  protected $pointsX;
  // y (up) direction posible rows
  protected $pointsY;
  // z (forward) direction posible rows
  protected $pointsZ;
  // translated shape, 0, 0, 0 based
  protected $pointsShape;

  public static function create($name) {
    $class = __NAMESPACE__ . '\\' . $name;
    return new $class();
  }

  /**
   * Try to fit me on a test-board.
   * Return a board where I and the rest of the queue matches.
   *
   * @return Board
   */
  public final function process(Board $board, array $queue) {
    $next = array_shift($queue);

    $usage = memory_get_usage();
    $humanUsage = $this->bytes($usage);
    $this->log("Enter function; memory = $humanUsage...", __FUNCTION__);

    // try all directions
    foreach ($this->mirrorPossible() as $mirr) {
      foreach ($this->directionsPossible() as $dir) {
        foreach ($this->rotationsPossible() as $rot) {
          $this->log("Loop $mirr, $dir, $rot...", __FUNCTION__);

          $res = $this->translate($dir, $rot, $mirr, $board);
          if (!$res) {
            return FALSE;
          }

          // loop right, up, away
          foreach ($this->pointsX as $offsetX) {
            foreach ($this->pointsY as $offsetY) {
              foreach ($this->pointsZ as $offsetZ) {
                $position = new Position($offsetX, $offsetY, $offsetZ, $dir, $rot);
                $this->log("Try $offsetX, $offsetY, $offsetZ...", __FUNCTION__);

                $result = $board->test($this, $position);

                // Do I fit?
                if ($result instanceof Board) {
                  $this->log("Match! Try next...", __FUNCTION__);

                  // Take the result to the next in the queue
                  $sure = $next->process($result, $queue);

                  // does the next fit?
                  if ($sure instanceof Board) {
                    $this->log("Others match too!", __FUNCTION__);
                    // exit
                    return $sure;
                  }
                }
              }
            }
          }
        }
      }
    }

    // I did not fit at all?
    return NULL;
  }

  public function directionsPossible() {
    return array(
      'x', 'y', 'z',
    );
  }

  public function rotationsPossible() {
    return array(
      0, 90, 180, 270,
    );
  }

  public function mirrorPossible() {
    return array('no', 'yes');
  }

  /**
   * 
   * @return Point[]
   */
  protected function coordinates() {
    return array();
  }

  public function translate($dir, $rot, $mirr, Board $board) {
    $this->pointsX = array();
    $this->pointsY = array();
    $this->pointsZ = array();
    $this->pointsShape = array();

    $base = $this->coordinates();

    /**
     * Point[]
     */
    $rotated = array();

    foreach ($base as $point) {
      $mirrorXY = 0;
      switch($mirr) {
        default:
          $this->log("Invalid mirror [$mirr]. Valid values are: yes, no.", __FUNCTION__);
          return FALSE;
        case 'no':
          $mirrorXY = 1;
          break;
        case 'yes':
          $mirrorXY = -1;
          break;
      }
      
      switch ($rot) {
        default:
          $this->log("Invalid rotation [$rot]. Valid values are: 0, 90, 180 and 270.", __FUNCTION__);
          return FALSE;
        case 0:
          $rotated[] = new Point($mirrorXY * $point->x, $mirrorXY * $point->y, $point->z, $point->color);
          break;
        case 90:
          $rotated[] = new Point($mirrorXY * $point->x, $mirrorXY * $point->z, -1 * $point->y, $point->color);
          break;
        case 180:
          $rotated[] = new Point($mirrorXY * $point->x, $mirrorXY * -1 * $point->y, -1 * $point->z, $point->color);
          break;
        case 270:
          $rotated[] = new Point($mirrorXY * $point->x, $mirrorXY * -1 * $point->z, $point->y, $point->color);
          break;
      }
    }

    // default offset
    $offset = null;

    foreach ($rotated as $point) {
      $p = NULL;

      switch ($dir) {
        default:
          $this->log("Invalid direction: [$dir]. Valid are: x, y, z.", __FUNCTION__);
          return FALSE;
        case 'x':
          $p = clone($point);
          break;
        case 'y':
          $p = new Point($point->z, $point->y, 0 - $point->x, $point->color);
          break;
        case 'z':
          $p = new Point($point->y, 0 - $point->x, $point->z, $point->color);
          break;
      }

      if (!$offset) {
        $offset = clone($p);
      } else {
        if ($p->x < $offset->x) {
          $offset->x = $p->x;
        }
        if ($p->y < $offset->y) {
          $offset->y = $p->y;
        }
        if ($p->z < $offset->z) {
          $offset->z = $p->z;
        }
      }

      // check offset
      $translated[] = $p;
    }

    $shapeX = array();
    $shapeY = array();
    $shapeZ = array();

    $max = null;

    // offset
    foreach ($translated as $point) {
      $point->x = $point->x - $offset->x;
      $point->y = $point->y - $offset->y;
      $point->z = $point->z - $offset->z;

      if (!$max) {
        $max = clone($point);
      } else {
        if ($point->x > $max->x) {
          $max->x = $point->x;
        }
        if ($point->y > $max->y) {
          $max->y = $point->y;
        }
        if ($point->z > $max->z) {
          $max->z = $point->z;
        }
      }

      $shapeX[$point->x] = $point->x;
      $shapeY[$point->y] = $point->y;
      $shapeZ[$point->z] = $point->z;
    }

    $this->pointsX = range(0, $board->dimX - $max->x);
    $this->pointsY = range(0, $board->dimY - $max->y);
    $this->pointsZ = range(0, $board->dimZ - $max->z);

    $this->pointsShape = $translated;

    return $result;
  }

}
