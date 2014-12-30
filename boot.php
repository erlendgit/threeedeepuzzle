<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */
require "vendor/autoload.php";

use \ThreeDeePuzzle\Shape;
use \ThreeDeePuzzle\Board;

//
// @todo Guess the expected color at the required position
// @todo Validate with the board
// @todo Apply the shape to the board
// @todo Give the result back in a human readable format.
//

$queue = array(
  Shape::create('AfterFour\\LadderWhite'),
  Shape::create('AfterFour\\Aech'),
  Shape::create('AfterFour\\Ladder'),
  Shape::create('AfterFour\\NS'),
  Shape::create('AfterFour\\CapitalEll'),
  Shape::create('AfterFour\\Won'),
  Shape::create('AfterFour\\WonSecond'),
  Shape::create('AfterFour\\You'),
  Shape::create('AfterFour\\Ell'),
  Shape::create('AfterFour\\EllSecond'),
  Shape::create('AfterFour\\Thee'),
  Shape::create('AfterFour\\Duck'),
);
$queue = array(
  Shape::create('ForFour\\Square'),
  Shape::create('ForFour\\Square2'),
  Shape::create('ForFour\\Square3'),
  Shape::create('ForFour\\Square4'),
  Shape::create('ForFour\\Square5'),
  Shape::create('ForFour\\Square6'),
  Shape::create('ForFour\\Square7'),
  Shape::create('ForFour\\Square8'),
);

$boot = array_shift($queue);
$result = $boot->process(new Board(4, 4, 4), $queue);


$usage = memory_get_usage();
$humanUsage = $boot->bytes($usage);
$boot->log("Final memory = $humanUsage...", "[[Script end]]");
