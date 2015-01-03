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
use \ThreeDeePuzzle\Erlend\Reporter as ErlendReporter;

//
// @TODO: (almost done) report during the way about the number of posibilities tried and yet to come
// @TODO: run the script in HipHop VM
//

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
  'G' => Shape::create('AfterFour\\WonSecond', 'G'),
  'H' => Shape::create('AfterFour\\You', 'H'),
  'I' => Shape::create('AfterFour\\Ell', 'I'),
  'J' => Shape::create('AfterFour\\EllSecond', 'J'),
  'K' => Shape::create('AfterFour\\Thee', 'K'),
  'L' => Shape::create('AfterFour\\Duck', 'L'),
);
$queue2 = array(
  Shape::create('ForFour\\Square', 'M'),
  Shape::create('ForFour\\Square2', 'O'),
  Shape::create('ForFour\\Square3', 'P'),
  Shape::create('ForFour\\Square4', 'S'),
  Shape::create('ForFour\\Square5', 'T'),
  Shape::create('ForFour\\Square6', 'U'),
  Shape::create('ForFour\\Square7', 'X'),
  Shape::create('ForFour\\Square8', 'Z'),
//  Shape::create('ForFour\\Square', 'E'),
);

$do_test = TRUE;
$do_test = FALSE;
if ($do_test) {
  $testboard = new Board(4,4,4);
  $shape1 = clone($queue['A']);
  $shape2 = clone($queue['C']);
  $shape3 = clone($queue['B']);

  $shape1->translate('z', 0, 'no', $testboard);
  $shape2->translate('x', 0, 'no', $testboard);
  $shape3->translate('x', 0, 'no', $testboard);
  $testboard->apply($shape1, new Position(0,1,0));
  $testboard->report();
  exit();
}

$result = NULL;
$boot = array_shift($queue);
$result = $boot->process(new Board(4, 4, 4), $queue, new Reporter());

if ($result) {
  $board->log('Full match!!!', 'end');
}

$usage = memory_get_peak_usage();
$humanUsage = $boot->bytes($usage);
$boot->log("Final memory = $humanUsage...", "[[Script end]]");
