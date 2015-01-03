<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle\Erlend;
use ThreeDeePuzzle\Reporter as BaseReporter;

class Reporter extends BaseReporter {
	public function report(Board $board, $subject = '') {
		// catch the default behaviour
		ob_start();
		parent::report($board, $subject);
		$msg = trim(ob_get_end());

		if ($msg != '') {
			// send a mail


		}
	}
}