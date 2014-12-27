<?php

require "vendor/autoload.php";

use \ThreeDeePuzzle\Shape;
use \ThreeDeePuzzle\Board;

// one shape can have one direction/rotation. Best would be the most complex shape.

$queue = array(
	Shape::create('AfterFour\\NSLittle'),
	Shape::create('AfterFour\\Thee'),
	Shape::create('AfterFour\\Ell'),
	Shape::create('AfterFour\\EllSecond'),
	Shape::create('AfterFour\\You'),
	Shape::create('AfterFour\\Won'),
	Shape::create('AfterFour\\WonSecond'),
	Shape::create('AfterFour\\CapitalEll'),
	Shape::create('AfterFour\\NS'),
	Shape::create('AfterFour\\Ladder'),
	Shape::create('AfterFour\\LadderWhite'),
	Shape::create('AfterFour\\Aech'),
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
$boot->log("Final memory = $humanUsage...", "__SCRIPT_END__");
