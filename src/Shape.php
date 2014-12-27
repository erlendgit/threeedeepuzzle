<?php

namespace ThreeDeePuzzle;

class Shape {
	use Logable;

	public function create($name) {
		return new __NAMESPACE__ . '\\' . $name;
	}

	/**
	 * Try to fit me on a test-board.
	 * Return a board where I and the rest of the queue matches.
	 *
	 * @return Board
	 */
	public final function process(Board $board, array $queue) {
		$next = array_shift($queue);

		$this->log("Enter function...", __FUNCTION__);

		// try all directions
		foreach ($this->directionsPossible as $dir) {
		$this->log("Loop $dir...", __FUNCTION__);
			// loop right, up, away
			foreach($this->xPossible($dir) as $offsetX) {
				foreach($this->yPossible($dir) as $offsetY) {
					foreach($this->zPossible($dir) as $offsetZ) {
						$position = new Position($offsetX, $offsetY, $offsetZ, $dir);
						$this->log("Try $offsetX, $offsetY, $offsetZ...", __FUNCTION__);

						$result = $board->test($this, $position);

						// Do I fit?
						if ($result instanceof Board) {
							$this->log("Match! Try next...", __FUNCTION__);

							// Take the result to the next in the queue
							$sure = $next->process($result, $queue);

							// does the next fit?
							if ($sure instanceof Board) {
								$this->log("Others match too!", __FUNCTION__);
								// exit
								return $sure;
							}
						}
					}
				}
			}
		}

		// I did not fit at all?
		return NULL;
	}

	public function xPossible($dir) {
		return array();
	}

	public function yPossible($dir) {
		return array();
	}

	public function zPossible($dir) {
		return array();
	}

	public function directionsPossible() {
		return array(
			'right',
			'left',
			'up', 'down',
			'away', 'back',
		);
	}

	protected function coordinates() {
		return array();
	}

	public function direction($dir) {
		$base = $this->coordinates();

		//// for example:
		$result = array();
		switch($dir) {
			case 'up':
			case 'down':
			case 'away',
			case 'back':
			case 'left':
			case 'right':
			default:
				$result = $base;
				break;
		}

		return $result;
	}
}