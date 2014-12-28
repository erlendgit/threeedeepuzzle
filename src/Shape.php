<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle;

class Shape {

  use Logable;

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
    foreach ($this->directionsPossible() as $dir) {
      foreach ($this->rotationsPossible() as $rot) {
        $this->log("Loop $dir, $rot...", __FUNCTION__);
        // loop right, up, away
        foreach ($this->xPossible($dir, $rot) as $offsetX) {
          foreach ($this->yPossible($dir, $rot) as $offsetY) {
            foreach ($this->zPossible($dir, $rot) as $offsetZ) {
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

    // I did not fit at all?
    return NULL;
  }

  public function xPossible($dir, $rot) {
    return array();
  }

  public function yPossible($dir, $rot) {
    return array();
  }

  public function zPossible($dir, $rot) {
    return array();
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

  protected function coordinates() {
    return array();
  }

  public function translate($dir, $rot) {
    $base = $this->coordinates();

    //// for example:
    $result = array();
    switch ($dir) {
      default:
        $result = $base;
        break;
    }

    return $result;
  }

}
