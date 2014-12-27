<?php

require "vendor/autoload.php";

use \ThreeDeePuzzle\Shape;
use \ThreeDeePuzzle\Board;

$queue = array(
	Shape::create('ForFour\\Square'),
	Shape::create('ForFour\\Square2'),
	Shape::create('ForFour\\Square3'),
	Shape::create('ForFour\\Square4'),
);

$boot = array_shift($queue);
$result = $boot->process(new Board(), $queue);
