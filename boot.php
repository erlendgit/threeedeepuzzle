<?php

require "vendor/autoload.php";

use \ThreeDeePuzzle\Shape;
use \ThreeDeePuzzle\Board;

//
// @todo Translate shape and steps to rotation
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
);

$boot = array_shift($queue);
$result = $boot->process(new Board(), $queue);


$usage = memory_get_usage();
$humanUsage = $boot->bytes($usage);
$boot->log("Final memory = $humanUsage...", "[[Script end]]");
