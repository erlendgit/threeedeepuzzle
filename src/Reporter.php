<?php

/**
 * @author Erlend ter Maat <erwitema@gmail.com>
 * @license GNU GPL version 3
 */

namespace ThreeDeePuzzle;

class Reporter {
	// when did I last sent a report?
	public $last_excerpt;

	// when did we start this trouble?
	public $start_timestamp;

	// what was in the last mail?
	public $last_count;
	// shape operations
	public $sops;

	// k=1000, M=1000000 Giga shape operations
	public $gigasops;

	public function __construct() {
		$this->last_excerpt = time();
		$this->start_timestamp = time();
		$this->last_count = 0;
		$this->sops = 0;
		$this->gigasops = 0;
	}

	public function report(Board $board, $title = '') {
		// log event and the board
		$this->sops = $this->sops+1;
		if ($this->sops > 1000000000) {
			$this->sops = 1;
			$this->gigasops = $this->gigasops + 1;
		}

		if ($title != '' || $this->last_excerpt < strtotime('-1 hours')) {

			$count_since_last = $this->gigasops - $this->last_count;

			if ($title) {
				print "# $title\n\n";
			}

			print "==\n";
			print "== Script started at " . date('r') . "\n";
			print "== Processed single shape operations: {$this->sops}\n";
			print "== Processed giga shape operations: {$this->gigasops}\n";
			print "== Processed since last report: {$count_since_last}\n";
			print "==\n";
			print "\n";

			// print the current board layout
			$board->report();

			$this->last_count = $this->gigasops;
			$this->last_excerpt = time();
		}
	}
}