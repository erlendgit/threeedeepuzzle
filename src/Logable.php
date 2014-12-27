<?php

namespace ThreeDeePuzzle;

trait Logable {
	public function log($msg, $context, $class=NULL) {
		if (!$class) {
			$class = get_class($this);
		}

		print "== $class::$context ==\n";
		print_r($msg);
		print "\n";
	}
}