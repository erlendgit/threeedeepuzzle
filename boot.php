<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

require "vendor/autoload.php";

use ThreeDeePuzzle\Shape;
use ThreeDeePuzzle\Board;
use ThreeDeePuzzle\Reporter;
use ThreeDeePuzzle\Position;
use ThreeDeePuzzle\AfterFour;
use ThreeDeePuzzle\ForFour;

/**
 * @var Shape[]
 */
$queue = array(
  'A' => Shape::create(AfterFour\Owl::class, 'A'),
  'B' => Shape::create(AfterFour\Camel::class, 'B'),
  'C' => Shape::create(AfterFour\Bat::class, 'C'),
  'D' => Shape::create(AfterFour\Lama::class, 'D'),
  'E' => Shape::create(AfterFour\Giraffe::class, 'E'),
  'F' => Shape::create(AfterFour\Saint::class, 'F'),
  'G' => Shape::create(AfterFour\Saint::class, 'G'),
  'H' => Shape::create(AfterFour\You::class, 'H'),
  'I' => Shape::create(AfterFour\Leopold::class, 'I'),
  'K' => Shape::create(AfterFour\Leopold::class, 'K'),
  'L' => Shape::create(AfterFour\Rambo::class, 'L'),
  'M' => Shape::create(AfterFour\Duck::class, 'M'),
);

$queue2 = array(
  Shape::create(ForFour\Square::class, 'M'),
  Shape::create(ForFour\Square::class, 'O'),
  Shape::create(ForFour\Square::class, 'P'),
  Shape::create(ForFour\Square::class, 'S'),
  Shape::create(ForFour\Square::class, 'T'),
  Shape::create(ForFour\Square::class, 'U'),
  Shape::create(ForFour\Square::class, 'X'),
  Shape::create(ForFour\Square::class, 'Z'),
);

print "Script start at " . date('r') . "\n\n\n";

$boot = array_shift($queue);
$boot->process(new Board(4, 4, 4), $queue, new Reporter());
