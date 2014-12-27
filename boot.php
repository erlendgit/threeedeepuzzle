<?php

require "vendor/autoload.php";

use \ThreeDeePuzzle\Shape;
use \ThreeDeePuzzle\Board;

$queue = array(
	Shape::create('Shape'),
	Shape::create('Shape'),
	Shape::create('Shape'),
	Shape::create('Shape'),
);

$boot = array_shift($queue);
$result = $boot->process(new Board(), $queue);
