<?php

namespace ThreeDeePuzzle;

class Shape {
	use Logable;
	
	/**
	 * Point[]
	 */
	protected $position;

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

		// try all directions
		foreach ($this->directionsPossible as $dir) {
			// loop right, up, away
			foreach($this->xPossible($dir) as $offsetX) {
				foreach($this->yPossible($dir) as $offsetY) {
					foreach($this->zPossible($dir) as $offsetZ) {
						$position = new Position($offsetX, $offsetY, $offsetZ, $dir);

						$result = $board->test($this, $position);

						// Do I fit?
						if ($result instanceof Board) {

							// Take the result to the next in the queue
							$sure = $next->process($result, $queue);

							// does the next fit?
							if ($sure instanceof Board) {
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
		return array(0, 1, 2);
	}

	public function yPossible($dir) {
		return array(0, 1, 2);
	}

	public function zPossible($dir) {
		return array(0, 1, 2);
	}

	public function directionsPossible() {
		return array(
			'right',
			// 'left',
			// 'up', 'down',
			// 'away', 'back',
		);
	}

	protected function coordinates() {
		return = array(
			//        ri up aw co
			new Point(0, 0, 0, 'white')
			new Point(0, 0, 1, 'black')
			new Point(0, 1, 0, 'black')
			new Point(0, 1, 1, 'white')
			new Point(1, 0, 0, 'black')
			new Point(1, 0, 1, 'white')
			new Point(1, 1, 0, 'white')
			new Point(1, 1, 1, 'black')
		);
	}

	public function direction($dir) {
		$base = $this->coordinates();
		return $base;

		//// for example:
		// $result = array();
		// switch($dir) {
		// 	case 'up':
		// 		foreach($base as $coordinate) {

		// 		}
		// 		break;
		// 	case 'down':
		// 		break;
		// 	case 'away',
		// 		break;
		// 	case 'back':
		// 		break;
		// 	case 'left':
		// 		break;
		// 	case 'right':
		// 	default:
		// 		$result = $base;
		// 		break;
		// }

		// return $result;
	}
}