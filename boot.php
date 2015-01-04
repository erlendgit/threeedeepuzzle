<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

require "vendor/autoload.php";

use \ThreeDeePuzzle\Shape;
use \ThreeDeePuzzle\Board;
use \ThreeDeePuzzle\Reporter;
use \ThreeDeePuzzle\Position;

/**
 * @var Shape[]
 */
$queue = array(
  'A' => Shape::create('AfterFour\\LadderWhite', 'A'),
  'B' => Shape::create('AfterFour\\Aech', 'B'),
  'C' => Shape::create('AfterFour\\Ladder', 'C'),
  'D' => Shape::create('AfterFour\\NS', 'D'),
  'E' => Shape::create('AfterFour\\CapitalEll', 'E'),
  'F' => Shape::create('AfterFour\\Won', 'F'),
  'G' => Shape::create('AfterFour\\Won', 'G'),
  'H' => Shape::create('AfterFour\\You', 'H'),
  'I' => Shape::create('AfterFour\\Ell', 'I'),
  'K' => Shape::create('AfterFour\\Ell', 'K'),
  'L' => Shape::create('AfterFour\\Thee', 'L'),
  'M' => Shape::create('AfterFour\\Duck', 'M'),
);

$queue2 = array(
  Shape::create('ForFour\\Square', 'M'),
  Shape::create('ForFour\\Square', 'O'),
  Shape::create('ForFour\\Square', 'P'),
  Shape::create('ForFour\\Square', 'S'),
  Shape::create('ForFour\\Square', 'T'),
  Shape::create('ForFour\\Square', 'U'),
  Shape::create('ForFour\\Square', 'X'),
  Shape::create('ForFour\\Square', 'Z'),
);

print "Script start at " . date('r') . "\n\n\n";

$boot = array_shift($queue);
$boot->process(new Board(4, 4, 4), $queue, new Reporter());
