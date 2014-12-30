<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */
require "vendor/autoload.php";

use \ThreeDeePuzzle\Shape;
use \ThreeDeePuzzle\Board;

//
// @todo Apply the shape to the board
// @todo Give the result back in a human readable format.
//

$queue = array(
  Shape::create('AfterFour\\LadderWhite', 'A'),
  Shape::create('AfterFour\\Aech', 'B'),
  Shape::create('AfterFour\\Ladder', 'C'),
  Shape::create('AfterFour\\NS', 'D'),
  Shape::create('AfterFour\\CapitalEll', 'E'),
  Shape::create('AfterFour\\Won', 'F'),
  Shape::create('AfterFour\\WonSecond', 'G'),
  Shape::create('AfterFour\\You', 'H'),
  Shape::create('AfterFour\\Ell', 'I'),
  Shape::create('AfterFour\\EllSecond', 'J'),
  Shape::create('AfterFour\\Thee', 'K'),
  Shape::create('AfterFour\\Duck', 'L'),
);
$queue = array(
  Shape::create('ForFour\\Square', 'M'),
//  Shape::create('ForFour\\Square2', 'O'),
//  Shape::create('ForFour\\Square3', 'P'),
//  Shape::create('ForFour\\Square4', 'S'),
//  Shape::create('ForFour\\Square5', 'T'),
//  Shape::create('ForFour\\Square6', 'U'),
//  Shape::create('ForFour\\Square7', 'X'),
//  Shape::create('ForFour\\Square8', 'Z'),
//  Shape::create('ForFour\\Square', 'E'),
);

$boot = array_shift($queue);
$board = new Board(4, 4, 4);
$result = $boot->process($board, $queue);

if ($result) {
  $board->report();
  $board->log('Full match!!!', 'end');
}

$usage = memory_get_peak_usage();
$humanUsage = $boot->bytes($usage);
$boot->log("Final memory = $humanUsage...", "[[Script end]]");
