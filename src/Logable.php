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

	public function bytes($size,$level=0,$precision=2,$base=1024) {
	    $unit = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB','YB');
	    $times = floor(log($size,$base));
	    return sprintf("%.".$precision."f",$size/pow($base,($times+$level))).$unit[$times+$level];
	}
}